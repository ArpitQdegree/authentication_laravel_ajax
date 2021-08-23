<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    //

    public function login(){
        return view('login');
    }

    public function user_login(Request $request){
        if(Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ])) {
            return response()->json(['success' => 'Successfully Logged in']);
        } else{
            return response()->json(['error' => 'Please enter valid credentials']);
        }
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect('/login');
    }
}
