<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Session;

class AdminNewController extends Controller
{
    public function new(){
        $user = DB::table('sii_users')->where('id', Auth::id())->first();

        if( $user->role == 'operator' ){
            return redirect('admin');
        }

        return view('cpanel.user.new', ['user' => $user]);
    }

    public function new_save(Request $request){
        $image = $request->file('image');
        $image_name = Str::random(32).'.jpg';

        if( Str::length($request->password) < 6 ){
            return redirect()->back()->withErrors(['password' => 'Password harus lebih dari 6 karakter.']);
        }

        $query = [
            'image' => 'image/profile/'.$image_name,
            'role' => $request->role,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(64),
            'created_at' => Carbon::now()
        ];

        $image->move('image/profile/', $image_name);

        if( DB::table('sii_users')->insert($query) ){
            // log
            $log_query = [
                'user_id' => Auth::id(),
                'action' => 'menambah',
                'object' => 'admin',
                'name' => $request->name,
                'created_at' => Carbon::now()
            ];
            DB::table('sii_log')->insert($log_query);

            return redirect('admin/list')->with('success', 'Admin baru berhasil ditambahkan.');
        }else{
            Session::flash('error', 'Maaf, admin baru gagal ditambahkan.');
            return redirect()->back();
        }
    }
}
