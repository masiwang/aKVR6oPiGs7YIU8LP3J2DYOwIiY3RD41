<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $user = DB::table('sii_users')
            ->where('id', Auth::id())
            ->first();

        $logs = DB::table('sii_log')->limit(20)->get();

        $industri = DB::table('sii_perusahaan')
            ->leftJoin('sii_industri_tipe', 'sii_industri_tipe.id', 'sii_perusahaan.tipe_industri')
            ->leftJoin('sii_kelurahan', 'sii_kelurahan.id', 'sii_perusahaan.kelurahan')
            ->leftJoin('sii_kecamatan', 'sii_kecamatan.id', 'sii_perusahaan.kecamatan')
            ->orderBy('id', 'desc')
            ->select(
                'sii_perusahaan.id as id',
                'badan_usaha',
                'nama_perusahaan',
                'nama_pemilik',
                'telepon',
                'tipe_industri as tipe_id',
                'sii_industri_tipe.name as tipe_industri',
                'komoditas',
                'jalan',
                'sii_kelurahan.name as kelurahan',
                'sii_kecamatan.name as kecamatan',
                'karyawan_laki',
                'karyawan_perempuan',
                'latitude',
                'longitude'
            );

        $map_data = $industri->get();
        $get_five = $industri->limit(5)->get();

        return view('cpanel.dashboard.index', [
            'user' => $user,
            'logs' => $logs,
            'industri' => $get_five,
            'map_data' => $map_data
        ]);
    }
}
