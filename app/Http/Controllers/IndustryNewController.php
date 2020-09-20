<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Session;

class IndustryNewController extends Controller
{
    public function new(){
        $user = DB::table('sii_users')
            ->where('id', Auth::id())
            ->first();
        $kelurahan = DB::table('sii_kelurahan')->get();
        $kecamatan = DB::table('sii_kecamatan')->get();
        $tipe_industri = DB::table('sii_industri_tipe')->get();
        $skala_industri = DB::table('sii_skala_industri')->get();

        return view('cpanel.industry.new', [
            'user' => $user, 
            'kelurahan' => $kelurahan, 
            'kecamatan' => $kecamatan, 
            'tipe_industri' => $tipe_industri,
            'skala_industri' => $skala_industri
        ]);
    }

    public function new_save(Request $request){
        if(!$request->file('image')){
            Session::flash('error', 'Maaf, gambar perusahaan harus diisi.');
            return redirect()->back();
        }

        $image = $request->file('image');
        $image_name = Str::random(32).'.jpg';

        $query = [
            'tipe_industri' => $request->tipe_industri,
            'kabupaten' => "Surakarta",
            'skala_industri' => $request->skala_industri,
            'badan_usaha' => $request->badan_usaha,
            'nama_perusahaan' => $request->nama_perusahaan,
            'nama_pemilik' => $request->nama_pemilik,
            'telepon' => $request->telepon,
            'fax' => $request->fax,
            'email' => $request->email,
            'website' => $request->website,
            'jalan' => $request->jalan,
            'kelurahan' => $request->kelurahan,
            'kecamatan' => $request->kecamatan,
            'izin_usaha' => $request->izin_usaha,
            'tahun_izin' => $request->tahun_izin,
            'kbli' => $request->kbli,
            'komoditas' => $request->komoditas,
            'jenis_produk' => $request->jenis_produk,
            'karyawan_laki' => $request->karyawan_laki,
            'karyawan_perempuan' => $request->karyawan_perempuan,
            'nilai_investasi' => $request->nilai_investasi,
            'nilai_produksi' => $request->nilai_produksi,
            'jumlah_kapasitas_produksi' => $request->jumlah_kapasitas_produksi,
            'satuan_kapasitas_produksi' => $request->satuan_kapasitas_produksi,
            'bahan_baku_utama' => $request->bahan_baku_utama,
            'nilai_bahan_baku' => $request->nilai_bahan_baku,
            'bahan_penolong' => $request->bahan_penolong,
            'nilai_bahan_penolong' => $request->nilai_bahan_penolong,
            'wilayah_pemasaran' => $request->wilayah_pemasaran,
            'negara_tujuan_export' => $request->negara_tujuan_export,
            'energi' => $request->energi,
            'limbah_dihasilkan' => $request->limbah_dihasilkan,
            'jumlah_limbah' => $request->jumlah_limbah,
            'satuan_limbah' => $request->satuan_limbah,
            'olahan_limbah' => $request->olahan_limbah,
            'nik' => $request->nik,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'file_foto' => 'image/perusahaan/'.$file_name,
            'tahun_data' => $request->tahun_data,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        $image->move('image/perusahaan/', $image_name);
        if( DB::table('sii_perusahaan')->insert($query) ){
            return redirect('admin/perusahaan')->with('success', 'Perusahaan berhasil ditambahkan.');
        }else{
            Session::flash('error', 'Maaf, perusahaan gagal ditambahkan.');
            return redirect()->back();
        }
    }
}
