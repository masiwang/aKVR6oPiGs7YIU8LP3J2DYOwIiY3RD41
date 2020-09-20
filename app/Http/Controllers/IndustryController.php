<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndustryController extends Controller
{
    public function index(Request $request){
        $user = DB::table('sii_users')
            ->where('id', Auth::id())
            ->select(
                'id',
                'name',
                'role'
            )
            ->first();

        $perusahaans = DB::table('sii_perusahaan')
            ->join('sii_industri_tipe', 'sii_industri_tipe.id', 'sii_perusahaan.tipe_industri')
            ->join('sii_kelurahan', 'sii_kelurahan.id', 'sii_perusahaan.kelurahan')
            ->join('sii_kecamatan', 'sii_kecamatan.id', 'sii_perusahaan.kecamatan')
            ->select(
                'sii_perusahaan.id as id',
                'sii_perusahaan.badan_usaha',
                'sii_perusahaan.nama_perusahaan',
                'sii_perusahaan.nama_pemilik',
                'sii_perusahaan.telepon',
                'sii_perusahaan.jalan',
                'sii_kelurahan.name as kelurahan',
                'sii_kecamatan.name as kecamatan',
                'sii_industri_tipe.name as tipe_industri',
                'sii_perusahaan.komoditas',
                'sii_perusahaan.karyawan_laki',
                'sii_perusahaan.karyawan_perempuan'
            );
        if($request->perusahaan){
            $perusahaans = $perusahaans->where('sii_perusahaan.nama_perusahaan', 'like', '%'.$request->perusahaan.'%');
        }

        if($request->kelurahan){
            $perusahaans = $perusahaans->where('sii_kelurahan.name', 'like', '%'.$request->kelurahan.'%');
        }

        if($request->kecamatan){
            $perusahaans = $perusahaans->where('sii_kecamatan.name', 'like', '%'.$request->kecamatan.'%');
        }

        if($request->tipe){
            $perusahaans = $perusahaans->where('sii_perusahaan.tipe_industri', $request->tipe);
        }

        if($request->komoditas){
            $perusahaans = $perusahaans->where('sii_perusahaan.komoditas', 'like', '%'.$request->komoditas.'%');
        }

        $perusahaans = $perusahaans->paginate(10);
        
        return view('cpanel.industry.index', ['user' => $user, 'perusahaans' => $perusahaans]);
    }
}
