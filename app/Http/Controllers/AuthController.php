<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
     }
 
     public function auth(Request $request){
        $data = [
           "name" => $request->username,
           "password" => $request->password
         ];
 
        if(!Auth::attempt($data)) return redirect()->back()->with('message','Username Atau Password Salah!');
 
        if(Auth::user()->role_id == 1 ) return redirect()->route('index');
        else if (Auth::user()->role_id == 2) return redirect()->route('bank.index');
        else if (Auth::user()->role_id == 3) return redirect()->route('admin.index');
        else if (Auth::user()->role_id == 4) return redirect()->route('kantin.index');
 }
 
 
     public function logout(){
       Auth::logout();
 
       request()->session()->invalidate();
 
       return redirect()->route('login');
     }
}
