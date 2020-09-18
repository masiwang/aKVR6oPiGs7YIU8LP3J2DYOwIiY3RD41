<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    protected $table = 'sii_perusahaan';
    protected $fillable = [
        'tipe_industri',
        'badan_usaha',
        'nama_perusahaan',
        'nama_pemilik',
        'jalan',
        'alamat_usaha',
        'kelurahan',
        'kecamatan',
        'telepon',
        'fax',
        'email',
        'web',
        'izin_usaha',
        'tahun_izin',
        'kbli',
        'komoditi',
        'jenis_produk',
        'tenaga_kerja_laki',
        'tenaga_kerja_perempuan',
        'nilai_investasi',
        'jumlah_kapasitas_produksi',
        'satuan_kapasitas_produksi',
        'nilai_produksi',
        'bahan_baku_utama',
        'nilai_bahan_baku',
        'bahan_penolong',
        'nilai_bahan_penolong',
        'wilayah_pemasaran_dalam_negeri',
        'negara_tujuan_export',
        'energi_yang_dibutuhkan',
        'limbah_yang_dihasilkan',
        'jumlah_limbah',
        'satuan_limbah',
        'olahan_limbah',
        'nik',
        'letak_geografis_latitude',
        'letak_geografis_longitude',
        'skala_industri',
        'file_foto'
    ];
}
