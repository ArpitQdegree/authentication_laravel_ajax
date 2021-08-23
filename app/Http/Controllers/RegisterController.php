<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //

    public function register(){
        return view('register');
    }

    public function save_user(Request $request){
        $user = User::where('email', $request['email'])->first();

        if($user){
            return response()->json(['exists' => 'Email already exists']);
        } else{
            $user = new User;
            $user->fname = $request['fname'];
            $user->lname = $request['lname'];
            $user->email = $request['email'];
            $user->password = bcrypt($request['password']);
        }

        $user->save();
        return response()->json(['success' => 'User Registered Successfully']);
    }
}
