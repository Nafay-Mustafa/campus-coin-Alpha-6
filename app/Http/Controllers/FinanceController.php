<?php
namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Bookmark;
use App\Models\Insight;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FinanceController extends Controller {
    private function availableCategories($type=null){
        $q=Category::where(fn($q)=>$q->whereNull('user_id')->orWhere('user_id',auth()->id()));
        return $type?$q->where('type',$type)->orderBy('name')->get():$q->orderBy('type')->orderBy('name')->get();
    }
    private function tips($transactions,$budgets){
        $tips=[];
        $expenses=$transactions->where('type','expense');
        $by=$expenses->groupBy(fn($t)=>$t->category->name)->map->sum('amount')->sortDesc();
        if($by->isNotEmpty()){
            $top=$by->first(); $name=$by->keys()->first();
            $tips[]="Your highest spending category this month is {$name} (PKR ".number_format($top,0)."). Try setting a small weekly limit for it.";
        }
        $food=$by->get('Food',0);
        if($food>0) $tips[]="If you reduce Food spending by 10%, you could keep about PKR ".number_format($food*.10,0)." more this month.";
        foreach($budgets as $b){
            $spent=$expenses->where('category_id',$b->category_id)->sum('amount');
            if($spent >= $b->limit_amount*.8) $tips[]="Your {$b->category->name} budget is ".round(($spent/max(1,$b->limit_amount))*100)."% used. Review upcoming spending.";
        }
        if(!$tips) $tips[]="Start logging every small expense for a week. Your spending pattern will become easier to understand.";
        return array_slice($tips,0,4);
    }
    public function dashboard(){
        $month=now()->startOfMonth();
        $tx=Transaction::with('category')->where('user_id',auth()->id())->where('date','>=',$month)->latest('date')->get();
        $income=$tx->where('type','income')->sum('amount'); $expense=$tx->where('type','expense')->sum('amount');
        $categories=$this->availableCategories(); $budgets=Budget::with('category')->where('user_id',auth()->id())->where('month',$month->toDateString())->get();
        $by=$tx->where('type','expense')->groupBy(fn($t)=>$t->category->name)->map->sum('amount');
        $months=[];$monthIncome=[];$monthExpense=[];
        for($i=5;$i>=0;$i--){$d=now()->subMonths($i);$months[]=$d->format('M Y');
            $monthIncome[]=Transaction::where('user_id',auth()->id())->where('type','income')->whereBetween('date',[$d->copy()->startOfMonth(),$d->copy()->endOfMonth()])->sum('amount');
            $monthExpense[]=Transaction::where('user_id',auth()->id())->where('type','expense')->whereBetween('date',[$d->copy()->startOfMonth(),$d->copy()->endOfMonth()])->sum('amount');
        }
        return view('dashboard',compact('tx','income','expense','categories','budgets','by','months','monthIncome','monthExpense'))->with('tips',$this->tips($tx,$budgets));
    }
    public function storeTransaction(Request $r){
        $data=$r->validate(['type'=>'required|in:income,expense','category_id'=>'required|integer','amount'=>'required|numeric|min:.01','description'=>'nullable|string|max:255','date'=>'required|date','is_recurring'=>'nullable|boolean','recurring_frequency'=>'nullable|in:monthly,weekly']);
        $cat=Category::whereIn('id',$this->availableCategories()->pluck('id'))->findOrFail($data['category_id']);
        abort_unless($cat->type===$data['type'],422,'Category type does not match transaction type.');
        $data['user_id']=auth()->id(); $data['is_recurring']=$r->boolean('is_recurring');
        $data['ai_suggested_category']=$this->suggestCategory($data['description']??'', $data['type'])?->id;
        Transaction::create($data);
        return back()->with('success','Transaction added successfully.');
    }
    private function suggestCategory($description,$type){
        $text=strtolower($description);
        $rules=$type==='expense'?['food'=>['food','cafe','restaurant','lunch','dinner','pizza','burger','canteen','delivery'],'transport'=>['bus','uber','careem','fuel','transport'],'hostel/rent'=>['rent','hostel','room'],'academics'=>['book','tuition','stationery','course','fee'],'subscriptions'=>['netflix','spotify','subscription','app'],'entertainment'=>['movie','cinema','outing']]:['allowance'=>['allowance','pocket money'],'part-time job'=>['salary','freelance','job'],'scholarship'=>['scholarship'],'gift'=>['gift']];
        foreach($rules as $name=>$words) foreach($words as $word) if(str_contains($text,$word))
            return $this->availableCategories($type)->first(fn($c)=>strtolower($c->name)===strtolower($name));
        return null;
    }
    public function destroyTransaction(Transaction $t){abort_unless($t->user_id===auth()->id(),403);$t->delete();return back()->with('success','Transaction deleted.');}
        public function storeCategory(Request $r){$d=$r->validate(['name'=>'required|string|max:80','type'=>'required|in:income,expense']);Category::create([...$d,'user_id'=>auth()->id(),'is_default'=>false]);return back()->with('success','Personal category created.');}
    public function destroyCategory(Category $c){abort_unless($c->user_id===auth()->id() && !$c->is_default,403);$c->delete();return back()->with('success','Category deleted.');}
    public function budgets(){
        $categories=$this->availableCategories('expense');$budgets=Budget::with('category')->where('user_id',auth()->id())->where('month',now()->startOfMonth()->toDateString())->get();
        return view('budgets',compact('categories','budgets'));
    }
    public function storeBudget(Request $r){$d=$r->validate(['category_id'=>'required|integer','limit_amount'=>'required|numeric|min:.01']);$cat=Category::whereIn('id',$this->availableCategories('expense')->pluck('id'))->findOrFail($d['category_id']);Budget::updateOrCreate(['user_id'=>auth()->id(),'category_id'=>$cat->id,'month'=>now()->startOfMonth()->toDateString()],['limit_amount'=>$d['limit_amount']]);return back()->with('success','Budget saved.');}
    public function destroyBudget(Budget $b){abort_unless($b->user_id===auth()->id(),403);$b->delete();return back()->with('success','Budget removed.');}
    public function reports(Request $r){
        $from=$r->input('from',now()->startOfMonth()->toDateString());$to=$r->input('to',now()->toDateString());
        $q=Transaction::with('category')->where('user_id',auth()->id())->whereBetween('date',[$from,$to]);
        if($r->filled('category_id'))$q->where('category_id',$r->category_id); if($r->filled('type'))$q->where('type',$r->type);
        $tx=$q->orderByDesc('date')->get();$categories=$this->availableCategories();return view('reports',compact('tx','from','to','categories'));
    }
    public function exportCsv(Request $r): StreamedResponse{
        $tx=Transaction::with('category')->where('user_id',auth()->id())->whereBetween('date',[$r->input('from',now()->startOfMonth()->toDateString()),$r->input('to',now()->toDateString())])->orderBy('date')->get();
        return response()->streamDownload(function()use($tx){$out=fopen('php://output','w');fputcsv($out,['Date','Type','Category','Amount','Description']);foreach($tx as $t)fputcsv($out,[$t->date->format('Y-m-d'),$t->type,$t->category->name,$t->amount,$t->description]);fclose($out);},'campus-coin-report.csv');
    }
    public function importCsv(Request $r){
        $r->validate(['csv'=>'required|file|mimes:csv,txt|max:2048']);$h=fopen($r->file('csv')->getRealPath(),'r');$header=fgetcsv($h);$count=0;
        while(($row=fgetcsv($h))!==false){if(count($row)<5)continue;[$date,$type,$category,$amount,$description]=$row;if(!in_array($type,['income','expense'])||!is_numeric($amount))continue;
            $cat=$this->availableCategories($type)->first(fn($c)=>strtolower($c->name)===strtolower(trim($category)))??Category::create(['name'=>trim($category),'type'=>$type,'user_id'=>auth()->id(),'is_default'=>false]);
            Transaction::create(['user_id'=>auth()->id(),'category_id'=>$cat->id,'amount'=>$amount,'type'=>$type,'description'=>$description,'date'=>$date]);$count++;
        } fclose($h);return back()->with('success',"Imported {$count} transactions.");
    }
    public function editTransaction(Transaction $transaction){abort_unless($transaction->user_id===auth()->id(),403);$categories=$this->availableCategories();return view('transaction-edit',compact('transaction','categories'));}
    public function updateTransaction(Request $r, Transaction $transaction){
        abort_unless($transaction->user_id===auth()->id(),403);
        $d=$r->validate(['type'=>'required|in:income,expense','category_id'=>'required|integer','amount'=>'required|numeric|min:.01','description'=>'nullable|string|max:255','date'=>'required|date','is_recurring'=>'nullable|boolean','recurring_frequency'=>'nullable|in:monthly,weekly']);
        $cat=$this->availableCategories($d['type'])->firstWhere('id',(int)$d['category_id']);abort_unless($cat,422);
        $d['is_recurring']=$r->boolean('is_recurring');$transaction->update($d);return redirect()->route('dashboard')->with('success','Transaction updated.');
    }
    public function bookmark(Request $r){$d=$r->validate(['title'=>'required|string|max:150','content'=>'required|string|max:1000','type'=>'nullable|string|max:30']);Bookmark::create(['user_id'=>auth()->id(),'title'=>$d['title'],'content'=>$d['content'],'type'=>$d['type']??'tip']);return back()->with('success','Saved to bookmarks.');}
    public function bookmarks(){return view('bookmarks',['bookmarks'=>Bookmark::where('user_id',auth()->id())->latest()->get()]);}
    public function deleteBookmark(Bookmark $bookmark){abort_unless($bookmark->user_id===auth()->id(),403);$bookmark->delete();return back()->with('success','Bookmark removed.');}
    public function insights(){ 
        $month=now()->startOfMonth();$tx=Transaction::with('category')->where('user_id',auth()->id())->whereBetween('date',[$month,now()])->get();
        $income=$tx->where('type','income')->sum('amount');$expense=$tx->where('type','expense')->sum('amount');$top=$tx->where('type','expense')->groupBy(fn($t)=>$t->category->name)->map->sum('amount')->sortDesc()->first();
        $name=$tx->where('type','expense')->groupBy(fn($t)=>$t->category->name)->map->sum('amount')->sortDesc()->keys()->first()??'No category';
        $summary=$expense>0?"You received PKR ".number_format($income,0)." and spent PKR ".number_format($expense,0)." this month. Your highest spending area is {$name} at PKR ".number_format($top??0,0).".":"There is not enough spending data yet for a detailed monthly insight.";
        $tip=$expense>0?"Try reducing {$name} spending by 10% next month and move that amount toward your savings goal.":"Log a few transactions first; the insight engine will use your own history.";
        $insight=Insight::updateOrCreate(['user_id'=>auth()->id(),'month'=>$month->toDateString()],['summary_text'=>$summary,'tip_text'=>$tip]);
        return view('insights',compact('insight'));
    }
    public function sitemap(){return view('sitemap');}
}