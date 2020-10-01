<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function get_auth_user(){
        $user = DB::table('sii_users')
        ->where('id', Auth::id())
        ->select(
            'id',
            'name',
            'role',
            'image',
            'phone',
            'email'
        )
        ->first();
        return $user;
    }

    public function new_log($action, $object, $name){
        $log_query = [
            'user_id' => Auth::id(),
            'action' => $action,
            'object' => $object,
            'name' => $name,
            'created_at' => Carbon::now()
        ];
        DB::table('sii_log')->insert($log_query);
    }

    public function operator_only(){
        $user = Auth::user();
        if(!($user->role == 'operator')){
            return back();
        }
    }

    public function pimpinan_only(){
        $user = Auth::user();
        if(!($user->role == 'pimpinan')){
            return back();
        }
    }

    public function upload_image($directory, $image){
        $image_name = Str::random(32).'.jpg';
        $image->move('image/'.$directory.'/', $image_name);
        return $image_name;
    }
}
