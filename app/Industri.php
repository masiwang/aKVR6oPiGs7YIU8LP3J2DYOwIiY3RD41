<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Industri extends Model
{
    protected $table = 'sii_industri';
    protected $fillable = [
        'img_url',
        'nama_industri',
        'nama_pemilik',
        'telepon',
        'jalan',
        'kelurahan',
        'kecamatan',
        'arcgis_x',
        'arcgis_y',
        'nilai_investasi',
        'omzet_penjualan',
        'tipe_industri',
        'produk',
        'bahan_baku',
        'bahan_penolong',
        'karyawan_laki',
        'karyawan_perempuan',
        'area_pemasaran'
    ];
}
