<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Imports\IndustriImport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Hash;

class AdminController extends Controller
{
    public function index(){
        $user = DB::table('sii_users')->where('id', Auth::id())->first();
        $admins = DB::table('sii_users')->get();

        return view('cpanel.user.index', ['user' => $user, 'admins' => $admins]);
    }
}
