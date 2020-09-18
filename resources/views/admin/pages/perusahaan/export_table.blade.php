<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
</head>
<body>
    <table class="table table-bordered">
        
        <tbody>
            <tr>
                <th>Tahun Data</th>
                <th>Kab/Kota</th>
                <th>Badan Usaha</th>
                <th>Perusahaan</th>
                <th>Pemilik</th>
                <th>Jalan</th>
                <th>Alamat Usaha</th>
                <th>Desa/Kel.</th>
                <th>Kecamatan</th>
                <th>Telepon</th>
                <th>Fax</th>
                <th>Email</th>
                <th>Website</th>
                <th>Izin Usaha</th>
                <th>Tahun Izin</th>
                <th>KBLI</th>
                <th>Komoditas</th>
                <th>Jenis Produk</th>
                <th>TK. Laki</th>
                <th>TK. Perempuan</th>
                <th>Nilai Investasi</th>
                <th>Jml. Kapasitas Produksi</th>
                <th>Satuan Kapasitas Produksi</th>
                <th>Nilai Produksi</th>
                <th>Bahan Baku Utama</th>
                <th>Nilai Bahan Baku</th>
                <th>Bahan Penolong</th>
                <th>Nilai Bahan Penolong</th>
                <th>Wilayah Pemasaran Dlm Negeri</th>
                <th>Negara Tujuan Export</th>
                <th>Energi yg Digunakan</th>
                <th>Limbah yg Dihasilkan</th>
                <th>Jumlah Limbah</th>
                <th>Satuan Limbah</th>
                <th>Olahan Limbah</th>
                <th>NIK</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Skala Industri</th>
            </tr>
            @foreach ($perusahaan as $p)
            <tr id="perusahaan-{{$p->id}}">
                <td>{{$p->tahun_data}}</td>
                <td>{{$p->kabupaten}}</td>
                <td>{{$p->badan_usaha}}</td>
                <td>{{$p->nama_perusahaan}}</td>
                <td>{{$p->nama_pemilik}}</td>
                <td>{{$p->jalan}}</td>
                <td>{{$p->alamat_usaha}}</td>
                <td>{{$p->kelurahan}}</td>
                <td>{{$p->kecamatan}}</td>
                <td>{{$p->telepon}}</td>
                <td>{{$p->fax}}</td>
                <td>{{$p->email}}</td>
                <td>{{$p->website}}</td>
                <td>{{$p->izin_usaha}}</td>
                <td>{{$p->tahun_izin}}</td>
                <td>{{$p->kbli}}</td>
                <td>{{$p->komoditas}}</td>
                <td>{{$p->jenis_produk}}</td>
                <td>{{$p->karyawan_laki}}</td>
                <td>{{$p->karyawan_perempuan}}</td>
                <td>{{$p->nilai_investasi}}</td>
                <td>{{$p->jumlah_kapasitas_produksi}}</td>
                <td>{{$p->satuan_kapasitas_produksi}}</td>
                <td>{{$p->nilai_produksi}}</td>
                <td>{{$p->bahan_baku_utama}}</td>
                <td>{{$p->nilai_bahan_baku}}</td>
                <td>{{$p->bahan_penolong}}</td>
                <td>{{$p->nilai_bahan_penolong}}</td>
                <td>{{$p->wilayah_pemasaran}}</td>
                <td>{{$p->negara_tujuan_export}}</td>
                <td>{{$p->energi_digunakan}}</td>
                <td>{{$p->limbah_dihasilkan}}</td>
                <td>{{$p->jumlah_limbah}}</td>
                <td>{{$p->satuan_limbah}}</td>
                <td>{{$p->olahan_limbah}}</td>
                <td>{{$p->nik}}</td>
                <td>{{$p->latitude}}</td>
                <td>{{$p->longitude}}</td>
                <td>{{$p->skala_industri}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
    </script>
</body>
</html>

