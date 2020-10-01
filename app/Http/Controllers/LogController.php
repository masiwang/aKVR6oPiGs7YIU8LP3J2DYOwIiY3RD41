<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;

class LogController extends Controller
{
    public function index(Request $request){
        $logs = new \App\Log;
        if($request->aktivitas){
            $logs = $logs->where('action', $request->aktivitas);
        }
        if($request->objek){
            $logs = $logs->where('object', $request->objek);
        } 
        $logs = $logs->orderBy('id', 'desc')->paginate(10);

        return view('admin.pages.logs.index', ['logs'=>$logs]);
    }
    public function new($action, $object, $name){
        $query = [
            'user_id'   => Session::get('userid'),
            'action'    => $action,
            'object'    => $object,
            'name'      => $name,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()
        ];
        \App\Log::insert($query);
        return true;
    }
}
