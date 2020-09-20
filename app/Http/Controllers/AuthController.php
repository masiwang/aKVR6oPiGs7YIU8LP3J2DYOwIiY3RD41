<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

class AuthController extends Controller
{
    public function login(){
        if(Auth::id()){
            return redirect('admin');
        }
        return view('auth.login');
    }
    public function login_do(Request $request){
        if(Auth::attempt($request->only('email', 'password'))){

            $log_query = [
                'user_id' => Auth::id(),
                'action' => 'masuk',
                'object' => 'panel',
                'name' => '',
                'created_at' => Carbon::now()
            ];
            DB::table('sii_log')->insert($log_query);

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
