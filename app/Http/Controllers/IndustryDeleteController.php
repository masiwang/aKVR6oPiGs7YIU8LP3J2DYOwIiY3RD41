<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class IndustryDeleteController extends Controller
{
    public function delete(Request $request){
        $perusahaan = DB::table('sii_perusahaan')
            ->where('id', $request->id);
        
        if($perusahaan->delete()){
            Session::flash('success', 'Perusahaan berhasil dihapus');
            return redirect('admin/perusahaan');
        }else{
            Session::flash('error', 'Perusahaan, artikel gagal dihapus');
            return redirect()->back();
        }
    }
}
