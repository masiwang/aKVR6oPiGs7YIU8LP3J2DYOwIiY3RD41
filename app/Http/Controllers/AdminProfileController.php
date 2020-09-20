<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Session;

class AdminProfileController extends Controller
{
    public function index(){
        $user = DB::table('sii_users')
            ->where('id', Auth::id())
            ->select(
                'image',
                'name',
                'email',
                'phone',
                'role'
            )
            ->first();
        $logs = DB::table('sii_log')
            ->where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();
        return view('cpanel.user.profile', ['user' => $user, 'logs' => $logs]);
    }

    public function update(Request $request){

        if(Str::length($request->password) > 1 && Str::length($request->password) < 6){
            return redirect()->back()->with('error', 'Maaf password Anda sangat lemah');
        }

        if($request->password){
            $query = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password)
            ];
        }else{
            $query = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone
            ];
        }

        $user = DB::table('sii_users')
            ->where('id', Auth::id());


        if($user->update($query)){

            $log_query = [
                'user_id' => Auth::id(),
                'action' => 'mengubah profil',
                'object' => 'admin',
                'name' => Auth::id(),
                'created_at' => Carbon::now()
            ];
            DB::table('sii_log')->insert($log_query);

            Session::flash('success', 'Profil berhasil diubah.');
            return redirect()->back();
        }else{
            Session::flash('error', 'Maaf, profil gagal diubah.');
            return redirect()->back();
        }
    }
    
    public function update_image(Request $request){
        $file = $request->file('image');
        $file_name = Str::random(32).'.jpg';

        $user = DB::table('sii_users')
            ->where('id', Auth::id());

        $old_file = $user->select('image')->first();

        $query = [
            'image' => 'image/profile/'.$file_name,
            'updated_at' => Carbon::now()
        ];
        
        if( $file->move('image/profile/', $file_name)){

            if( $user->update($query) ){

                if(!File::exists(public_path().$old_file->image)){
                    File::delete($old_file->image);
                }

                $log_query = [
                    'user_id' => Auth::id(),
                    'action' => 'mengubah profil',
                    'object' => 'admin',
                    'name' => Auth::id(),
                    'created_at' => Carbon::now()
                ];
                DB::table('sii_log')->insert($log_query);

                Session::flash('success', 'Profil berhasil diubah.');
                return redirect()->back();
            }else{
                Session::flash('error', 'Maaf, profil gagal diubah.');
                return redirect()->back();
            }

        }
    }
}

