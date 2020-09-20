<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PerusahaanExport;

class IndustryExportController extends Controller
{
    public function export(Request $request){
        $perusahaan = DB::table('sii_perusahaan')
            ->leftJoin('sii_industri_tipe', 'sii_industri_tipe.id', 'sii_perusahaan.tipe_industri')
            ->leftJoin('sii_kelurahan', 'sii_kelurahan.id', 'sii_perusahaan.kelurahan')
            ->leftJoin('sii_kecamatan', 'sii_kecamatan.id', 'sii_perusahaan.kecamatan')
            ->leftJoin('sii_skala_industri', 'sii_skala_industri.id', 'sii_perusahaan.skala_industri')
            ->select(
                'sii_perusahaan.id as id',
                'tahun_data',
                'kabupaten',
                'badan_usaha',
                'nama_perusahaan',
                'nama_pemilik',
                'jalan',
                'alamat_usaha',
                'sii_kelurahan.name as kelurahan',
                'sii_kecamatan.name as kecamatan',
                'telepon',
                'fax',
                'email',
                'website',
                'izin_usaha',
                'tahun_izin',
                'kbli',
                'komoditas',
                'jenis_produk',
                'karyawan_laki',
                'karyawan_perempuan',
                'nilai_investasi',
                'jumlah_kapasitas_produksi',
                'satuan_kapasitas_produksi',
                'nilai_produksi',
                'bahan_baku_utama',
                'nilai_bahan_baku',
                'bahan_penolong',
                'nilai_bahan_penolong',
                'wilayah_pemasaran',
                'negara_tujuan_export',
                'energi',
                'limbah_dihasilkan',
                'jumlah_limbah',
                'satuan_limbah',
                'olahan_limbah',
                'nik',
                'latitude',
                'longitude',
                'sii_skala_industri.name as skala_industri',
                'sii_industri_tipe.name as tipe_industri'
            );
        if($request->perusahaan){
            $perusahaan = $perusahaan->where('sii_perusahaan.nama_perusahaan', 'like', '%'.$request->perusahaan.'%');
        }
        if($request->tahun_data){
            $perusahaan = $perusahaan->where('sii_perusahaan.tahun_data', $request->industri);
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
        if($request->produk){
            $perusahaan = $perusahaan->where('sii_perusahaan.produk', 'like','%'.$request->produk.'%');
        }
        $perusahaan = $perusahaan->get();

        $log_query = [ 'user_id' => Auth::id(),
            'action' => 'mengeksport',
            'object' => 'perusahaan',
            'name' => 'sebanyak '.count($perusahaan),
            'created_at' => Carbon::now()
        ];
        DB::table('sii_log')->insert($log_query);

        return (new PerusahaanExport($perusahaan))->download('siika_surakarta.xlsx');
    }
}