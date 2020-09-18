<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

class AuthController extends Controller
{
    public function login(Request $request){
        if(Auth::attempt($request->only('email', 'password'))){
            $user = \App\User::where('email', $request->email)->first();
            Session::put([
                'userid'  => $user->id,
                'role'  => $user->role
            ]);
            return redirect('admin');
        }else{
            return back()->with('auth-error', '');
        }
    }
    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect('login');;
    }
}
