<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndustryDetailController extends Controller
{
    public function detail($id){
        $user = DB::table('sii_users')
            ->where('id', Auth::id())
            ->first();
        
        $perusahaan = DB::table('sii_perusahaan')
            ->join('sii_industri_tipe', 'sii_industri_tipe.id', 'sii_perusahaan.tipe_industri')
            ->join('sii_kelurahan', 'sii_kelurahan.id', 'sii_perusahaan.kelurahan')
            ->join('sii_kecamatan', 'sii_kecamatan.id', 'sii_perusahaan.kecamatan')
            ->join('sii_skala_industri', 'sii_skala_industri.id', 'sii_perusahaan.skala_industri')
            ->select(
                'sii_perusahaan.id as perusahaan_id',
                'sii_perusahaan.file_foto',
                'sii_perusahaan.tahun_data',
                'sii_perusahaan.badan_usaha',
                'sii_perusahaan.nama_perusahaan',
                'sii_perusahaan.nama_pemilik',
                'sii_perusahaan.jalan',
                'sii_kelurahan.name as kelurahan',
                'sii_kecamatan.name as kecamatan',
                'sii_perusahaan.latitude',
                'sii_perusahaan.longitude',
                'sii_perusahaan.telepon',
                'sii_perusahaan.fax',
                'sii_perusahaan.email',
                'sii_perusahaan.website',
                'sii_perusahaan.izin_usaha',
                'sii_perusahaan.tahun_izin',
                'sii_perusahaan.kbli',
                'sii_perusahaan.nik',
                'sii_skala_industri.name as skala_industri',
                'sii_perusahaan.karyawan_laki',
                'sii_perusahaan.karyawan_perempuan',
                'sii_industri_tipe.name as tipe_industri',
                'sii_perusahaan.jenis_produk',
                'sii_perusahaan.komoditas',
                'sii_perusahaan.bahan_baku_utama',
                'sii_perusahaan.nilai_bahan_baku',
                'sii_perusahaan.nilai_bahan_penolong',
                'sii_perusahaan.jumlah_kapasitas_produksi',
                'sii_perusahaan.satuan_kapasitas_produksi',
                'sii_perusahaan.nilai_produksi',
                'sii_perusahaan.nilai_investasi',
                'sii_perusahaan.wilayah_pemasaran',
                'sii_perusahaan.negara_tujuan_export',
                'sii_perusahaan.energi',
                'sii_perusahaan.limbah_dihasilkan',
                'sii_perusahaan.jumlah_limbah',
                'sii_perusahaan.satuan_limbah',
                'sii_perusahaan.olahan_limbah'
            )
            ->where('sii_perusahaan.id', $id)
            ->first();
            
        return view('cpanel.industry.detail', ['user' => $user, 'perusahaan' => $perusahaan]);
    }
}
