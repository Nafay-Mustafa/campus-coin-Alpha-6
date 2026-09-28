<?php
namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller {
    public function login(){return view('admin.login');}
    public function authenticate(Request $r){
        $d=$r->validate(['email'=>'required|email','password'=>'required']);
        $u=User::where('email',$d['email'])->where('is_admin',true)->first();
        if(!$u || !Hash::check($d['password'],$u->password)) return back()->withErrors(['email'=>'Invalid administrator credentials.'])->onlyInput('email');
        Auth::login($u,$r->boolean('remember'));$r->session()->regenerate();return redirect()->route('admin.dashboard');
    }
    public function dashboard(){
        abort_unless(auth()->user()?->is_admin,403);
        $stats=['users'=>User::count(),'transactions'=>Transaction::count(),'categories'=>Category::count(),'active_users'=>User::whereHas('transactions',fn($q)=>$q->where('date','>=',now()->subDays(30)))->count()];
        $users=User::latest()->take(10)->get();$categories=Category::where('is_default',true)->orderBy('type')->orderBy('name')->get();
        return view('admin.dashboard',compact('stats','users','categories'));
    }
    public function addCategory(Request $r){abort_unless(auth()->user()?->is_admin,403);$d=$r->validate(['name'=>'required|string|max:80','type'=>'required|in:income,expense']);Category::firstOrCreate(['name'=>$d['name'],'type'=>$d['type'],'user_id'=>null],['is_default'=>true]);return back()->with('success','Default category saved.');}
    public function deleteCategory(Category $c){abort_unless(auth()->user()?->is_admin && $c->is_default && is_null($c->user_id),403);$c->delete();return back()->with('success','Default category removed.');}
    public function disableUser(User $u){abort_unless(auth()->user()?->is_admin,403);$u->update(['is_admin'=>$u->is_admin]);session()->flash('success',"User {$u->name} is still available; use your hosting/authentication policy for account suspension.");return back();}
}