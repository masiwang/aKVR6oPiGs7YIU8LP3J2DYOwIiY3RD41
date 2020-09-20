<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminLogController extends Controller
{
    public function index(){
        $user = DB::table('sii_users')
            ->where('id', Auth::id())
            ->select(
                'id',
                'name',
                'role'
            )
            ->first();

        $logs = DB::table('sii_log')
            ->orderBy('id', 'desc')
            ->paginate(10);
        
        return view('cpanel.user.log', ['user' => $user, 'logs' => $logs]);
    }
}
