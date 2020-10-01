<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class IndustryEditController extends Controller
{
    public function edit($id){
        if( Auth::user()->role == 'pimpinan' ){
            return back();
        }
        $user = DB::table('sii_users')
            ->where('id', Auth::id())
            ->first();
        
        $perusahaan = DB::table('sii_perusahaan')
            ->where('id', $id)
            ->first();

        $kelurahan = DB::table('sii_kelurahan')->get();
        
        $kecamatan = DB::table('sii_kecamatan')->get();

        $tipe_industri = DB::table('sii_industri_tipe')->get();

        $skala_industri = DB::table('sii_skala_industri')->get();

        return view('cpanel.industry.edit', [
            'user' => $user, 
            'perusahaan' => $perusahaan, 
            'kelurahan' => $kelurahan, 
            'kecamatan' => $kecamatan,
            'tipe_industri' => $tipe_industri,
            'skala_industri' => $skala_industri
            ]);
    }

    public function edit_save(Request $request){
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
            'alamat_usaha' => $request->alamat_usaha,
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
            'tahun_data' => $request->tahun_data,
            'updated_at' => Carbon::now()
        ];

        $perusahaan = DB::table('sii_perusahaan')->where('id', $request->id);

        if( $perusahaan->update($query) ){

            $log_query = [
                'user_id' => Auth::id(),
                'action' => 'mengubah',
                'object' => 'perusahaan',
                'name' => 'id '.$request->id,
                'created_at' => Carbon::now()
            ];
            DB::table('sii_log')->insert($log_query);

            return redirect('admin/perusahaan/'.$request->id.'/detail')->with('success', 'Perusahaan berhasil diubah.');
        }else{
            return redirect()->back()->withErrors(['error', 'Perusahaan gagal diubah.'])->withInput();
        }
    }

    public function edit_image(Request $request){
        $image = $request->file('image');
        $image_name = Str::random(32).'.jpg';

        $perusahaan = DB::table('sii_perusahaan')
            ->where('id', $request->id);

        $old_file = $perusahaan->select('file_foto')->first();
        
        $query = [
            'file_foto' => 'image/perusahaan/'.$image_name,
            'updated_at' => Carbon::now()
        ];

        if( $image->move('image/perusahaan/', $image_name) ){

            if( $perusahaan->update($query) ){

                if(!File::exists(public_path().$old_file->file_foto)){
                    File::delete($old_file->file_foto);
                }

                $log_query = [
                    'user_id' => Auth::id(),
                    'action' => 'mengubah',
                    'object' => 'perusahaan',
                    'name' => 'id '.$request->id,
                    'created_at' => Carbon::now()
                ];
                DB::table('sii_log')->insert($log_query);

                return redirect('admin/perusahaan/'.$request->id.'/detail')->with('success', 'Foto perusahaan berhasil diubah');

            }else{

                Session::flash('error', 'Maaf, gambar artikel gagal diubah.');
                return redirect()->back();

            }
        }
    }
}
