<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class ProfileController extends Controller {
 public function edit(){return view('profile-settings',['user'=>auth()->user()]);}
 public function update(Request $r){$d=$r->validate(['name'=>'required|string|max:255','academic_year'=>'nullable|string|max:100','monthly_allowance'=>'nullable|numeric|min:0','saving_goal'=>'nullable|numeric|min:0']);auth()->user()->update($d);return back()->with('success','Profile updated successfully.');}
}