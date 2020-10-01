<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndustryController extends Controller
{
    public function getPerusahaan(Request $request){
        $perusahaan = new \App\Perusahaan;
        $perusahaan = $perusahaan->leftJoin(
            'sii_kelurahan',
            'sii_perusahaan.kelurahan',
            'sii_kelurahan.id'
        )->leftJoin(
            'sii_kecamatan',
            'sii_perusahaan.kecamatan',
            'sii_kecamatan.id'
        )->join(
            'sii_industri_tipe',
            'sii_perusahaan.tipe_industri',
            'sii_industri_tipe.id'
        )->select(
            'sii_perusahaan.id',
            'sii_perusahaan.badan_usaha',
            'sii_perusahaan.nama_perusahaan',
            'sii_perusahaan.jalan',
            'sii_kelurahan.name as kelurahan',
            'sii_kecamatan.name as kecamatan',
            'sii_industri_tipe.name as tipe_industri',
            'sii_perusahaan.komoditas as komoditas'
        );
        if($request->industri){
            $perusahaan = $perusahaan->where('sii_perusahaan.nama_perusahaan', 'like', '%'.$request->industri.'%');
        }
        
        if($request->kelurahan){
            $perusahaan = $perusahaan->where('sii_kelurahan.name', $request->kelurahan);
        }

        if($request->kecamatan){
            $perusahaan = $perusahaan->where('sii_kecamatan.name', $request->kecamatan);
        }

        if($request->tipe){
            $perusahaan = $perusahaan->where('sii_industri_tipe.id', $request->tipe);
        }

        if($request->komoditas){
            $perusahaan = $perusahaan->where('sii_perusahaan.komoditas', 'like','%'.$request->komoditas.'%');
        }
        
        $perusahaan = $perusahaan->paginate(10);
        
        return view('home/perusahaan', ['user' => Auth::user(),'perusahaan' => $perusahaan]);
    }
}
