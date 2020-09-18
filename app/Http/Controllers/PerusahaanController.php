<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use DB;

use App\Imports\PerusahaanImport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

use Illuminate\Support\Facades\Storage;

use App\Exports\PerusahaanExport;

class PerusahaanController extends Controller
{
    public function index_desktop(Request $request){
        $perusahaan = new \App\Perusahaan;
        $perusahaan = $perusahaan->leftJoin('sii_industri_tipe', 'sii_industri_tipe.id', 'sii_perusahaan.tipe_industri');
        $perusahaan = $perusahaan->leftJoin('sii_kelurahan', 'sii_kelurahan.id', 'sii_perusahaan.kelurahan');
        $perusahaan = $perusahaan->leftJoin('sii_kecamatan', 'sii_kecamatan.id', 'sii_perusahaan.kecamatan');
        $perusahaan = $perusahaan->select(
            'sii_perusahaan.id as id',
            'badan_usaha',
            'nama_perusahaan',
            'nama_pemilik',
            'telepon',
            'sii_industri_tipe.name as tipe_industri',
            'komoditas',
            'jalan',
            'sii_kelurahan.name as kelurahan',
            'sii_kecamatan.name as kecamatan',
            'karyawan_laki',
            'karyawan_perempuan'
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

        if($request->produk){
            $perusahaan = $perusahaan->where('sii_perusahaan.produk', 'like','%'.$request->produk.'%');
        }
        $perusahaan = $perusahaan->paginate(20);

        return view('admin.desktop.perusahaan_list', ['perusahaan' => $perusahaan]);
    }

    public function view($id){
        $perusahaan = new \App\Perusahaan;
        $perusahaan = $perusahaan->leftJoin('sii_industri_tipe', 'sii_industri_tipe.id', 'sii_perusahaan.tipe_industri');
        $perusahaan = $perusahaan->leftJoin('sii_skala_industri', 'sii_skala_industri.id', 'sii_perusahaan.skala_industri');
        $perusahaan = $perusahaan->leftJoin('sii_kelurahan', 'sii_kelurahan.id', 'sii_perusahaan.kelurahan');
        $perusahaan = $perusahaan->leftJoin('sii_kecamatan', 'sii_kecamatan.id', 'sii_perusahaan.kecamatan');
        $perusahaan = $perusahaan->select(
            'sii_perusahaan.id as perusahaan_id',
            'sii_industri_tipe.name as tipe_industri',
            'sii_skala_industri.name as skala_industri_name',
            'badan_usaha',
            'nama_perusahaan',
            'nama_pemilik',
            'telepon',
            'fax',
            'email',
            'website',
            'komoditas',
            'jalan',
            'sii_kelurahan.name as kelurahan',
            'sii_kecamatan.name as kecamatan',
            'izin_usaha',
            'tahun_izin',
            'kbli',
            'jenis_produk',
            'karyawan_laki',
            'karyawan_perempuan',
            'nilai_investasi',
            'nilai_produksi',
            'jumlah_kapasitas_produksi',
            'satuan_kapasitas_produksi',
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
            'file_foto',
            'tahun_data'
        );
        $perusahaan = $perusahaan->where('sii_perusahaan.id', $id)->first();
        return view('admin.desktop.perusahaan_view', ['perusahaan' => $perusahaan]);
    }

    public function create_view(){
        $kelurahan = \App\Kelurahan::select('id', 'name')->get();
        $kecamatan = \App\Kecamatan::select('id', 'name')->get();
        $tipe_industri = \App\TipeIndustri::select('id', 'name')->get();
        $skala_industri = \App\SkalaIndustri::select('id', 'name')->get();
        return view('admin/desktop/perusahaan_new', [
            'kelurahan'=>$kelurahan,
            'kecamatan'=>$kecamatan,
            'tipe_industri'=>$tipe_industri,
            'skala_industri'=>$skala_industri,
        ]);
    }

    public function create_save(Request $request){
        $file_name = time().'.'.$request->file->extension();
        $request->file->move(public_path('image/perusahaan/'), $file_name);
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
            'file_foto' => 'image/perusahaan/'.$file_name,
            'tahun_data' => $request->tahun_data,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        
        if(\App\Perusahaan::insert($query)){
            $log = new LogController();
            $log->new('menambah', 'perusahaan', $request->nama_perusahaan);
            return redirect('admin/perusahaan')->with('success', 'Perusahaan berhasil di tambahkan');
        }else{
            return back()->with('failed', 'Perusahaan gagal di tambahkan. Periksa kembali form Anda');
        };
    }

    public function edit_view($id){
        $tipe_industri = \App\TipeIndustri::all();
        $skala_industri = \App\SkalaIndustri::all();
        $kelurahan = \App\Kelurahan::all();
        $kecamatan = \App\Kecamatan::all();
        $perusahaan = \App\Perusahaan::find($id);

        return view('admin.desktop.perusahaan_edit', [
            'tipe_industri' => $tipe_industri,
            'skala_industri' => $skala_industri,
            'kelurahan' => $kelurahan,
            'kecamatan' => $kecamatan,
            'perusahaan' => $perusahaan,
        ]);
    }

    public function edit_save(Request $request, $id){
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
        $perusahaan = \App\Perusahaan::where('id', $id);
        if($perusahaan->update($query)){
            $log = new LogController();
            $log->new('mengubah', 'perusahaan', $request->nama_perusahaan);
            return redirect('admin/perusahaan/'.$id.'/view')->with('success', 'Perusahaan berhasil diubah');
        }else{
            return back()->with('error', 'Perusahaan gagal diubah. Periksa kembali form Anda');
        };
    }

    public function edit_image(Request $request, $id){
        $perusahaan = \App\Perusahaan::find($id);
        $old_image = $perusahaan->image_url;
        File::delete($old_image);

        $file_name = time().'.'.$request->file->extension();
        $request->file->move(public_path('image/perusahaan/'), $file_name);
        $query = [
            'file_foto' => 'image/perusahaan/'.$file_name,
            'updated_at'=> Carbon::now()
        ];
        if($perusahaan->update($query)){
            return redirect('admin/perusahaan/'.$id.'/view')->with('success', 'Perusahaan berhasil diubah');
        }else{
            return back()->with('error', 'Perusahaan gagal diubah. Periksa kembali form Anda');
        }
    }

    public function delete_view($id){
        $perusahaan = \App\Perusahaan::find($id);
        return view('admin.desktop.perusahaan_delete', ['perusahaan' => $perusahaan]);
    }

    public function delete($id){
        $perusahaan = \App\Perusahaan::find($id);
        if($perusahaan->delete()){
            return redirect('admin/perusahaan')->with('success', 'Perusahaan berhasil dihapus.');
        }else{
            return back()->with('error', 'Perusahaan tidak dapat dihapus. Ulangi kembali penghapusan.');
        }
    }

    public function download_template(){
        return Storage::disk('public')->download('data/template.xlsx');
        // return Storage::disk('public')->delete('image/perusahaan/Screenshot_1.png');
    }

    public function import(){
        $tipe_industri = \App\TipeIndustri::all();
        return view('admin.desktop.perusahaan_import', ['tipe_industri' => $tipe_industri]);
    }

    public function import_foto_save(Request $request){
        foreach($request->file('content') as $c){
            $file_name = $c->getClientOriginalName();
            $path = Storage::putFileAs('public/image/perusahaan', $c, $file_name);
            // $c->store('image/perusahaan', $file_name);
        };
        return back()->with('success_foto', 'Folder foto telah berhasil di upload');
    }

    public function import_speadsheet_save(Request $request){
        $file_name = $request->file->getClientOriginalName();
        $request->file->move(public_path('excel'), $file_name);

        $array = Excel::toCollection(new PerusahaanImport, public_path('excel').'/'.$file_name);
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
            \App\Perusahaan::insert($query[$i]);
        }
        $log = new LogController();
            $log->new('mengimport', 'perusahaan', 'sebanyak '.count($query));
        return back()->with('success_spreadsheet', 'Spreadsheet telah berhasil di upload');
    }

    

    public function export(){
        return view('admin/pages/perusahaan/export');
    }

    public function export_xlsx(Request $request){
        $perusahaan = new \App\Perusahaan;
        $perusahaan = $perusahaan->leftJoin('sii_industri_tipe', 'sii_industri_tipe.id', 'sii_perusahaan.tipe_industri');
        $perusahaan = $perusahaan->leftJoin('sii_kelurahan', 'sii_kelurahan.id', 'sii_perusahaan.kelurahan');
        $perusahaan = $perusahaan->leftJoin('sii_kecamatan', 'sii_kecamatan.id', 'sii_perusahaan.kecamatan');
        $perusahaan = $perusahaan->select(
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
            'skala_industri',
            'sii_industri_tipe.name as tipe_industri'
        );
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
        // return $perusahaan;
        $log = new LogController();
        $log->new('mengekspor', 'perusahaan', '');
        return (new PerusahaanExport($perusahaan))->download('siika_surakarta.xlsx');
        // return (new PerusahaanExport)->customQuery($perusahaan)->download('invoices.xlsx');
    }
}
