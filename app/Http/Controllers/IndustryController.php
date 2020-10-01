<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class IndustryController extends Controller
{
    public function perusahaan($id=null, $nama=null, $tipe=null, $kelurahan=null, $kecamatan=null, $komoditas=null, $select=null){
        $perusahaan = DB::table('sii_perusahaan'); // inisiasi tabel perusahaan
        // jika $select maka
        if($select){
            $perusahaan = $perusahaan->join('sii_industri_tipe', 'sii_industri_tipe.id', 'sii_perusahaan.tipe_industri')
            ->join('sii_kelurahan', 'sii_kelurahan.id', 'sii_perusahaan.kelurahan')
            ->join('sii_kecamatan', 'sii_kecamatan.id', 'sii_perusahaan.kecamatan')
            ->join('sii_skala_industri', 'sii_skala_industri.id', 'sii_perusahaan.skala_industri')
            ->select(
                'sii_perusahaan.id as id',
                'sii_perusahaan.file_foto',
                'sii_perusahaan.tahun_data',
                'sii_perusahaan.badan_usaha',
                'sii_perusahaan.nama_perusahaan',
                'sii_perusahaan.nama_pemilik',
                'sii_perusahaan.jalan',
                'sii_kelurahan.id as kelurahan_id',
                'sii_kelurahan.name as kelurahan',
                'sii_kecamatan.id as kecamatan_id',
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
                'sii_perusahaan.sektor_industri',
                'sii_perusahaan.industri_kreatif',
                'sii_perusahaan.nik',
                'sii_skala_industri.name as skala_industri',
                'sii_skala_industri.id as skala_industri_id',
                'sii_perusahaan.karyawan_laki',
                'sii_perusahaan.karyawan_perempuan',
                'sii_industri_tipe.name as tipe_industri',
                'sii_industri_tipe.id as industri_tipe_id',
                'sii_perusahaan.jenis_produk',
                'sii_perusahaan.komoditas',
                'sii_perusahaan.bahan_baku_utama',
                'sii_perusahaan.nilai_bahan_baku',
                'sii_perusahaan.bahan_penolong',
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
            );
        }
        // jika $id tidak null
        if($id){
            $perusahaan = $perusahaan->where('sii_perusahaan.id', $id);
        }
        // jika $nama tidak null
        if($nama){
            $perusahaan = $perusahaan->where('sii_perusahaan.nama_perusahaan', 'like', '%'.$nama.'%');
        }
        // jika kelurahan tidak null
        if($kelurahan){
            $perusahaan = $perusahaan->where('sii_kelurahan.name', 'like', '%'.$kelurahan.'%');
        }
        // jika kecamatan tidak null
        if($kecamatan){
            $perusahaan = $perusahaan->where('sii_kecamatan.name', 'like', '%'.$kecamatan.'%');
        }
        // jika tipe tidak null
        if($tipe){
            $perusahaan = $perusahaan->where('sii_perusahaan.tipe_industri', $tipe);
        }
        // jika komoditas tidak null
        if($komoditas){
            $perusahaan = $perusahaan->where('sii_perusahaan.komoditas', 'like', '%'.$komoditas.'%');
        }
        return $perusahaan;
    }

    private function query($tipe='new', $request=null, $image_name=null){
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
            'sektor_industri' => $request->sektor_industri,
            'industri_kreatif' => $request->industri_kreatif,
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
        ]; // inisiasi query utama
        // jika tipe == new (membuat perusahaan baru)
        if($tipe == 'new'){
            $query = array_merge($query, array(
                'file_foto' => 'image/perusahaan/'.$image_name,
                'created_at' => Carbon::now()
            ));
        }
        // jika tipe == edit (mengubah data perusahaan lama)
        if($tipe == 'edit'){
            $query = array_merge($query, array('updated_at' => Carbon::now()));
        }
        return $query;
    }

    public function index(Request $request){
        $perusahaan = $this->perusahaan(
            $id = null,
            $nama = $request->perusahaan,
            $tipe = $request->tipe,
            $kelurahan = $request->kelurahan,
            $kecamatan = $request->kecamatan,
            $komoditas = $request->komoditas,
            $select = 1
        )->paginate(10)->onEachSide(0); // mengambil data perusanaan (select) berdasarkan nama, tipe, kelurahan, kecamatan, komoditas
        return view('cpanel.industry.index', ['user' => $this->get_auth_user(), 'perusahaans' => $perusahaan]);
    }

    public function index_guest(Request $request){
        $perusahaan = $this->perusahaan(
            $id = null,
            $nama = $request->perusahaan,
            $tipe = $request->tipe,
            $kelurahan = $request->kelurahan,
            $kecamatan = $request->kecamatan,
            $komoditas = $request->komoditas,
            $select = 1
        )->paginate(10)->onEachSide(0); // mengambil data perusanaan (select) berdasarkan nama, tipe, kelurahan, kecamatan, komoditas
        return view('guest.industry', ['user' => $this->get_auth_user(), 'perusahaans' => $perusahaan]);
    }

    public function delete(Request $request){
        $this->operator_only(); // method ini hanya dapat diakses oleh operator
        $this->perusahaan($id=$request->id)->delete(); // menghapus perusahaan berdasarkan $request->id
        $this->new_log('menghapus', 'perusahaan', 'id '.$request->id); // menuliskan log baru
        return redirect('admin/perusahaan')->with('success', 'Perusahaan berhasil dihapus');
    }

    public function detail($id){
        $perusahaan = $this->perusahaan($id, null, null, null, null, null, true)->first(); // mengambil data perusahaan (select) berdasarkan id
        return view('cpanel.industry.detail', ['user' => $this->get_auth_user(), 'perusahaan' => $perusahaan]);
    }

    public function new(){
        $this->operator_only(); // method ini hanya dapat diakses oleh operator
        $kelurahan = DB::table('sii_kelurahan')->get(); // mengambil data kelurahan
        $kecamatan = DB::table('sii_kecamatan')->get(); //mengambil data kecamatan
        $tipe_industri = DB::table('sii_industri_tipe')->get(); // mengambil data tipe industri
        $skala_industri = DB::table('sii_skala_industri')->get(); // mengambil data skala industri
        return view('cpanel.industry.new', [
            'user' => $this->get_auth_user(), 
            'kelurahan' => $kelurahan, 
            'kecamatan' => $kecamatan, 
            'tipe_industri' => $tipe_industri,
            'skala_industri' => $skala_industri
        ]);
    }

    public function new_save(Request $request){
        $this->operator_only(); // method ini hanya dapat diakses oleh operator
        $image_name = $this->upload_image('perusahaan', $request->file('image')); // melakukan upload gambar $request->file('image) dengan return berupa nama image
        $query = $this->query('new', $request, $image_name); // inisiasi query input data perusahaan baru
        $this->perusahaan()->insert($query); // eksekusi query input data perusahaan baru
        $this->new_log('menambah', 'perusahaan', $request->nama_perusahaan); // menuliskan log baru
        return redirect('admin/perusahaan')->with('success', 'Perusahaan berhasil ditambahkan.'); // redirect ke list perusahaan dengan notifikasi sukses
    }

    public function edit($id){
        $this->operator_only(); // method ini hanya dapat diakses oleh operator
        $perusahaan = $this->perusahaan($id, null, null, null, null, null, true)->first(); // mengambil data perusahaan berdasarkan $Id
        $kelurahan = DB::table('sii_kelurahan')->get(); // mengambil data kelurahan
        $kecamatan = DB::table('sii_kecamatan')->get(); // mengambil data kecamatan
        $tipe_industri = DB::table('sii_industri_tipe')->get(); // mengambil data tipe industri
        $skala_industri = DB::table('sii_skala_industri')->get(); // mengambil data skala industri
        return view('cpanel.industry.edit', [
            'user' => $this->get_auth_user(), 
            'perusahaan' => $perusahaan, 
            'kelurahan' => $kelurahan, 
            'kecamatan' => $kecamatan,
            'tipe_industri' => $tipe_industri,
            'skala_industri' => $skala_industri
        ]);
    }
    public function edit_image(Request $request){
        $this->operator_only(); // method ini hanya dapat diakses oleh operator
        $old_image = $this->perusahaan($request->id, null, null, null, null, null, true)->first()->file_foto; // mengambil nama image perusahaan sebelumnya
        $image_name = $this->upload_image('perusahaan', $request->file('image')); // upload image baru dengan return nama image
        $query = [
            'file_foto' => 'image/perusahaan/'.$image_name, // inisiasi query update image
            'updated_at' => Carbon::now()
        ];
        if(!File::exists(public_path().$old_file->file_foto)){
            File::delete($old_file->file_foto); // menghapus foto lama jika ada
        }
        $this->new_log('mengubah', 'perusahaan', 'id '.$request->id); // menuliskan log baru
        return redirect('admin/perusahaan/'.$request->id.'/detail')->with('success', 'Foto perusahaan berhasil diubah'); // redirect ke halaman detail perusahaan dengan notifikasi sukses
    }
    
    public function edit_save(Request $request){
        $this->operator_only(); // method ini hanya dapat diakses oleh operator
        $query = $this->query('edit', $request, null); // inisiasi query update data perusahaan
        $this->perusahaan($id = $request->id)->update($query); // eksekusi update data perusahaan
        $this->new_log('mengubah', 'perusahaan', 'id '.$request->id); // menuliskan log baru
        return redirect('admin/perusahaan/'.$request->id.'/detail')->with('success', 'Perusahaan berhasil diubah.'); // redirect ke halaman detail perusahaan dengan notifikasi sukses
    }
}
