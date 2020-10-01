<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PerusahaanImport;

class IndustryImportController extends Controller
{
    public function import(){
        if( Auth::user()->role == 'pimpinan' ){
            return back();
        }
        $user = DB::table('sii_users')->where('id', Auth::id())->first();
        $tipe_industri = DB::table('sii_industri_tipe')->get();
        return view('cpanel.industry.import', ['user' => $user, 'tipe_industri' => $tipe_industri]);
    }

    public function download_template(){
        return response()->download(public_path().'excel/template.xlsx', 'template_industri.xlsx');
    }

    public function images_save(Request $request){
        foreach($request->file('images') as $image){
            $image_name = $image->getClientOriginalName();
            $image->move('image/perusahaan/', $image_name);
        };
        return back()->with('success_foto', 'Folder foto telah berhasil di upload');
    }

    public function spreadsheet_save(Request $request){
        $file_name = $request->file->getClientOriginalName();
        $request->file->move(public_path().'/excel', $file_name);

        $array = Excel::toCollection(new PerusahaanImport, public_path().'/excel'.'/'.$file_name);
        $query = array();
        for($i = 1; $i < count($array[0]); $i++){
            $data = [
                'tipe_industri'             => $request->tipe_industri,
                'tahun_data'                => ($array[0][$i][0]) ? ($array[0][$i][0]) : ($request->tahun_data),
                'kabupaten'                 => 'Surakarta',
                'badan_usaha'               => $array[0][$i][2],
                'nama_perusahaan'           => $array[0][$i][3],
                'nama_pemilik'              => $array[0][$i][4],
                'jalan'                     => $array[0][$i][5],
                'alamat_usaha'              => $array[0][$i][6],
                'kelurahan'                 => (\App\Kelurahan::where('name', $array[0][$i][7])->first())['id'],
                'kecamatan'                 => (\App\Kelurahan::where('name', $array[0][$i][7])->first())['id_kecamatan'],
                'telepon'                   => $array[0][$i][9],
                'fax'                       => $array[0][$i][10],
                'email'                     => $array[0][$i][11],
                'website'                       => $array[0][$i][12],
                'izin_usaha'                => $array[0][$i][13],
                'tahun_izin'                => $array[0][$i][14],
                'kbli'                      => $array[0][$i][15],
                'sektor_industri'           => $array[0][$i][16],
                'industri_kreatif'          => $array[0][$i][17],
                'komoditas'                 => $array[0][$i][18],
                'jenis_produk'              => $array[0][$i][19],
                'karyawan_laki'             => $array[0][$i][20],
                'karyawan_perempuan'        => $array[0][$i][21],
                'nilai_investasi'           => $array[0][$i][22],
                'jumlah_kapasitas_produksi' => $array[0][$i][23],
                'satuan_kapasitas_produksi' => $array[0][$i][24],
                'nilai_produksi'            => $array[0][$i][25],
                'bahan_baku_utama'          => $array[0][$i][26],
                'nilai_bahan_baku'          => $array[0][$i][27],
                'bahan_penolong'            => $array[0][$i][28],
                'nilai_bahan_penolong'      => $array[0][$i][29],
                'wilayah_pemasaran'         => $array[0][$i][30],
                'negara_tujuan_export'      => $array[0][$i][31],
                'energi'                    => $array[0][$i][32],
                'limbah_dihasilkan'         => $array[0][$i][33],
                'jumlah_limbah'             => $array[0][$i][34],
                'satuan_limbah'             => $array[0][$i][35],
                'olahan_limbah'             => $array[0][$i][36],
                'nik'                       => $array[0][$i][37],
                'latitude'                  => ($array[0][$i][38] > 999999) ? round($array[0][$i][38]/10) : $array[0][$i][38],
                'longitude'                 => ($array[0][$i][39] > 9999999) ? round($array[0][$i][39]/10) : $array[0][$i][39],
                'skala_industri'            => $array[0][$i][40],
                'file_foto'                 => $array[0][$i][41],
            ];
            array_push($query, $data);
        }
        for ($i=0; $i < count($query); $i++) { 
            DB::table('sii_perusahaan')->insert($query[$i]);
        }

        File::delete('/excel'.'/'.$file_name);

        $log_query = [
            'user_id' => Auth::id(),
            'action' => 'mengimport',
            'object' => 'perusahaan',
            'name' => 'sebanyak '.count($query),
            'created_at' => Carbon::now()
        ];
        DB::table('sii_log')->insert($log_query);

        return back()->with('success_spreadsheet', 'Spreadsheet telah berhasil di upload');
    }
}
