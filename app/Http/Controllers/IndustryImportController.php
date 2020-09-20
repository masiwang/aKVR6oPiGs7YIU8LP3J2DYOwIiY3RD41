<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PerusahaanImport;

class IndustryImportController extends Controller
{
    public function import(){
        $user = DB::table('sii_users')->where('id', Auth::id())->first();
        $tipe_industri = DB::table('sii_industri_tipe')->get();
        return view('cpanel.industry.import', ['user' => $user, 'tipe_industri' => $tipe_industri]);
    }

    public function download_template(){
        return response()->download('excel/template.xlsx', 'template_industri.xlsx', 200);
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
        $request->file->move('/excel', $file_name);

        $array = Excel::toCollection(new PerusahaanImport, '/excel'.'/'.$file_name);
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
                'komoditas'                 => $array[0][$i][16],
                'jenis_produk'              => $array[0][$i][17],
                'karyawan_laki'             => $array[0][$i][18],
                'karyawan_perempuan'        => $array[0][$i][19],
                'nilai_investasi'           => $array[0][$i][20],
                'jumlah_kapasitas_produksi' => $array[0][$i][21],
                'satuan_kapasitas_produksi' => $array[0][$i][22],
                'nilai_produksi'            => $array[0][$i][23],
                'bahan_baku_utama'          => $array[0][$i][24],
                'nilai_bahan_baku'          => $array[0][$i][25],
                'bahan_penolong'            => $array[0][$i][26],
                'nilai_bahan_penolong'      => $array[0][$i][27],
                'wilayah_pemasaran'         => $array[0][$i][28],
                'negara_tujuan_export'      => $array[0][$i][29],
                'energi'                    => $array[0][$i][30],
                'limbah_dihasilkan'         => $array[0][$i][31],
                'jumlah_limbah'             => $array[0][$i][32],
                'satuan_limbah'             => $array[0][$i][33],
                'olahan_limbah'             => $array[0][$i][34],
                'nik'                       => $array[0][$i][35],
                'latitude'                  => ($array[0][$i][36] > 999999) ? round($array[0][$i][36]/10) : $array[0][$i][36],
                'longitude'                 => ($array[0][$i][37] > 9999999) ? round($array[0][$i][37]/10) : $array[0][$i][37],
                'skala_industri'            => $array[0][$i][38],
                'file_foto'                 => $array[0][$i][39],
            ];
            array_push($query, $data);
        }
        for ($i=0; $i < count($query); $i++) { 
            DB::table('sii_perusahaan')->insert($query[$i]);
        }

        File::delete('/excel'.'/'.$file_name);

        $log = new LogController();
        $log->new('mengimport', 'perusahaan', 'sebanyak '.count($query));

        return back()->with('success_spreadsheet', 'Spreadsheet telah berhasil di upload');
    }
}
