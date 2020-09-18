<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    protected function get_stats($tipe, $stats){
        $industri = new \App\Perusahaan;
        $industri = $industri->where('tipe_industri', $tipe);
        if($stats=="industri"){
            return $industri->count();
        }elseif ($stats=="karyawan") {
            $l = $industri->sum('karyawan_laki');
            $p = $industri->sum('karyawan_perempuan');
            return (int)$l + (int)$p;
        }
    }

    protected function get_graph_data($tipe){
        $kecamatan = \App\Kecamatan::get(['id', 'name']);
        $result = array();
        for ($i=0; $i < count($kecamatan); $i++) { 
            $industri = new \App\Perusahaan;
            $industri = $industri->where('kecamatan', $kecamatan[$i]->id);
            if($tipe > 0){
                $industri = $industri->where('tipe_industri', $tipe);
            }
            array_push($result, $industri->count());
        }
        return $result;
    }
    
    public function index(){
        $stats = array(
            'industri' => array(
                $this->get_stats(1, 'industri'),
                $this->get_stats(2, 'industri'),
                $this->get_stats(3, 'industri'),
            ),
            'karyawan' => array(
                $this->get_stats(1, 'karyawan'),
                $this->get_stats(2, 'karyawan'),
                $this->get_stats(3, 'karyawan'),
            )
        );
        $graph = array(
            'tipe1' => $this->get_graph_data(1),
            'tipe2' => $this->get_graph_data(2),
            'tipe3' => $this->get_graph_data(3),
            'semua' => $this->get_graph_data(0),
        );
        $kecamatan = $kecamatan = \App\Kecamatan::get('name');

        $industri = new \App\Perusahaan;
        $industri = $industri->leftJoin(
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
            'sii_perusahaan.nama_pemilik',
            'sii_perusahaan.telepon',
            'sii_perusahaan.jalan',
            'sii_perusahaan.latitude as latitude',
            'sii_perusahaan.longitude as longitude',
            'sii_kelurahan.name as kelurahan',
            'sii_kecamatan.name as kecamatan',
            'sii_industri_tipe.id as tipe_id',
            'sii_industri_tipe.name as tipe_industri',
            'komoditas as produk',
            'sii_perusahaan.karyawan_laki',
            'sii_perusahaan.karyawan_perempuan'
        );
        $map_data = $industri->get();
        $table_data = $industri->orderBy('id', 'desc')->limit(10)->get();
        $artikel = \App\Article::paginate(4, ['*'], 'article');

        $slide = \App\Article::orderBy('id', 'desc')->limit(5)->get();
        // return $artikel;
        return view('home.desktop', ['stats' => $stats, 'graph'=>$graph, 'kecamatan' => $kecamatan, 'perusahaan' => $table_data, 'map_data' => $map_data, 'artikel'=>$artikel, 'slide'=>$slide]);
    }

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
        
        return view('home/perusahaan', ['perusahaan' => $perusahaan]);
    }

    public function index_mobile(){
        $stats = array(
            'industri' => array(
                $this->get_stats(1, 'industri'),
                $this->get_stats(2, 'industri'),
                $this->get_stats(3, 'industri'),
            ),
            'karyawan' => array(
                $this->get_stats(1, 'karyawan'),
                $this->get_stats(2, 'karyawan'),
                $this->get_stats(3, 'karyawan'),
            )
        );
        $graph = array(
            'tipe1' => $this->get_graph_data(1),
            'tipe2' => $this->get_graph_data(2),
            'tipe3' => $this->get_graph_data(3),
            'semua' => $this->get_graph_data(0),
        );
        $kecamatan = $kecamatan = \App\Kecamatan::get('name');

        $industri = new \App\Perusahaan;
        $industri = $industri->leftJoin(
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
            'sii_perusahaan.nama_pemilik',
            'sii_perusahaan.telepon',
            'sii_perusahaan.jalan',
            'sii_perusahaan.latitude as latitude',
            'sii_perusahaan.longitude as longitude',
            'sii_kelurahan.name as kelurahan',
            'sii_kecamatan.name as kecamatan',
            'sii_industri_tipe.id as tipe_id',
            'sii_industri_tipe.name as tipe_industri',
            'komoditas as produk',
            'sii_perusahaan.karyawan_laki',
            'sii_perusahaan.karyawan_perempuan'
        );
        $map_data = $industri->get();
        $table_data = $industri->orderBy('id', 'desc')->limit(5)->get();
        $artikel = \App\Article::paginate(4, ['*'], 'article');

        $slide = \App\Article::orderBy('id', 'desc')->limit(5)->get();
        // return $artikel;
        return view('home.mobile', ['stats' => $stats, 'graph'=>$graph, 'kecamatan' => $kecamatan, 'perusahaan' => $table_data, 'map_data' => $map_data, 'artikel'=>$artikel, 'slide'=>$slide]);
    }
}
