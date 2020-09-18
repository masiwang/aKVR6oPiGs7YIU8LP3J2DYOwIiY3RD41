@extends('_master')

@section('title')
    Dashboard
@endsection

@section('content')
    @include('admin.components._navbar')
    <div class="container">
        @if (\Session::has('success'))
            <div class="row">
                <div class="col-12 px-0">
                    <div class="alert alert-success" role="alert">
                        {{\Session::get('success')}}
                    </div>
                </div>
            </div>
        @endif
        @if (\Session::has('error'))
            <div class="row">
                <div class="col-12 px-0">
                    <div class="alert alert-danger" role="alert">
                        {{\Session::get('error')}}
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-12 bg-white rounded shadow p-4">
                <h4 class="text-blue">Lihat Perusahaan</h4>
                <hr>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td><b>Foto Perusahaan</b></td>
                            <td><img src="{{asset($perusahaan->file_foto)}}" alt="" srcset="" style="max-height: 150px"></td>
                        <tr>
                        <tr>
                            <td><b>Tahun Data</b></td>
                            <td>{{$perusahaan->tahun_data}}</td>
                        </tr>
                        <tr>
                            <td style="width: 20%"><b>Badan Usaha</b></td>
                            <td>{{$perusahaan->badan_usaha}}</td>
                        </tr>
                        <tr>
                            <td><b>Nama Perusahaan</b></td>
                            <td>{{$perusahaan->nama_perusahaan}}</td>
                        </tr>
                        <tr>
                            <td><b>Nama Pemilik</b></td>
                            <td>{{$perusahaan->nama_pemilik}}</td>
                        </tr>
                        <tr>
                            <td><b>Alamat Perusahaan</b></td>
                            <td>{{$perusahaan->jalan}}</td>
                        </tr>
                        <tr>
                            <td><b>Kelurahan</b></td>
                            <td>{{$perusahaan->kelurahan}}</td>
                        </tr>
                        <tr>
                            <td><b>Kecamatan</b></td>
                            <td>{{$perusahaan->kecamatan}}</td>
                        </tr>
                        <tr>
                            <td><b>Latitude</b></td>
                            <td>{{$perusahaan->latitude}}</td>
                        </tr>
                        <tr>
                            <td><b>Longitude</b></td>
                            <td>{{$perusahaan->longitude}}</td>
                        </tr>
                        <tr>
                            <td><b>Telepon</b></td>
                            <td>{{$perusahaan->telepon}}</td>
                        </tr>
                        <tr>
                            <td><b>Fax</b></td>
                            <td>{{$perusahaan->fax}}</td>
                        </tr>
                        <tr>
                            <td><b>Email</b></td>
                            <td>{{$perusahaan->email}}</td>
                        </tr>
                        <tr>
                            <td><b>Website</b></td>
                            <td>{{$perusahaan->website}}</td>
                        </tr>
                        <tr>
                            <td><b>Izin Usaha</b></td>
                            <td>{{$perusahaan->izin_usaha}}</td>
                        </tr>
                        <tr>
                            <td><b>Tahun Izin</b></td>
                            <td>{{$perusahaan->tahun_izin}}</td>
                        </tr>
                        <tr>
                            <td><b>KBLI</b></td>
                            <td>{{$perusahaan->kbli}}</td>
                        </tr>
                        <tr>
                            <td><b>NIK</b></td>
                            <td>{{$perusahaan->nik}}</td>
                        </tr>
                        <tr>
                            <td><b>Skala Industri</b></td>
                            <td>{{$perusahaan->skala_industri}}</td>
                        </tr>
                        <tr>
                            <td><b>Karyawan Laki-laki</b></td>
                            <td>{{$perusahaan->karyawan_laki}}</td>
                        </tr>
                        <tr>
                            <td><b>Karyawan Perempuan</b></td>
                            <td>{{$perusahaan->karyawan_perempuan}}</td>
                        </tr>
                        <tr>
                            <td><b>Tipe Industri</b></td>
                            <td>{{$perusahaan->tipe_industri}}</td>
                        </tr>
                        <tr>
                            <td><b>Jenis Produk</b></td>
                            <td>{{$perusahaan->jenis_produk}}</td>
                        </tr>
                        <tr>
                            <td><b>Komoditas</b></td>
                            <td>{{$perusahaan->komoditas}}</td>
                        </tr>
                        <tr>
                            <td><b>Bahan Baku Utama</b></td>
                            <td>{{$perusahaan->bahan_baku_utama}}</td>
                        </tr>
                        <tr>
                            <td><b>Nilai Bahan Baku</b></td>
                            <td>{{$perusahaan->nilai_bahan_baku}}</td>
                        </tr>
                        <tr>
                            <td><b>Bahan Penolong</b></td>
                            <td>{{$perusahaan->nilai_bahan_penolong}}</td>
                        </tr>
                        <tr>
                            <td><b>Jumlah Kapasitas Produksi</b></td>
                            <td>{{$perusahaan->jumlah_kapasitas_produksi}}</td>
                        </tr>
                        <tr>
                            <td><b>Satuan Kapasitas Produksi</b></td>
                            <td>{{$perusahaan->satuan_kapasitas_produksi}}</td>
                        </tr>
                        <tr>
                            <td><b>Nilai Produksi</b></td>
                            <td>{{$perusahaan->nilai_produksi}}</td>
                        </tr>
                        <tr>
                            <td><b>Nilai Investasi</b></td>
                            <td>{{$perusahaan->nilai_investasi}}</td>
                        </tr>
                        <tr>
                            <td><b>Wilayah Pemasaran</b></td>
                            <td>{{$perusahaan->wilayah_pemasaran}}</td>
                        </tr>
                        <tr>
                            <td><b>Negara Tujuan Eksport</b></td>
                            <td>{{$perusahaan->negara_tujuan_export}}</td>
                        </tr>
                        <tr>
                            <td><b>Energi yang Digunakan</b></td>
                            <td>{{$perusahaan->energi}}</td>
                        </tr>
                        <tr>
                            <td><b>Limbah yang Dihasilkan</b></td>
                            <td>{{$perusahaan->limbah_dihasilkan}}</td>
                        </tr>
                        <tr>
                            <td><b>Jumlah Limbah</b></td>
                            <td>{{$perusahaan->jumlah_limbah}}</td>
                        </tr>
                        <tr>
                            <td><b>Satuan Limbah</b></td>
                            <td>{{$perusahaan->satuan_limbah}}</td>
                        </tr>
                        <tr>
                            <td><b>Olahan Limbah</b></td>
                            <td>{{$perusahaan->olahan_limbah}}</td>
                        </tr>
                    </tbody>
                 </table>
                 <div class="row">
                    <div class="col-12 text-right">
                        <a class="btn btn-secondary" style="width: 6rem">Kembali</a>
                        <a href="{{url('/admin/perusahaan/'.$perusahaan->perusahaan_id.'/edit')}}" class="btn btn-primary" style="width: 6rem">Edit</a>
                    </div>
                 </div>
            </div>
        </div>
    </div>
    <div style="height: 4rem"></div>
    @include('admin.desktop._footer')
    <script type="module">
        import Utm from 'https://cdn.jsdelivr.net/npm/geodesy@2/utm.js';

        var arcx = document.getElementById("Latitude").placeholder;
        var arcy = document.getElementById("Longitude").placeholder;
        var nama = document.getElementById("NamaIndustri").placeholder;
        var jalan = document.getElementById("Jalan").placeholder;
        var stringxy = '49 S '+arcx+' '+arcy;
        const utmCoord = Utm.parse(stringxy);
        const latLongP = utmCoord.toLatLon();
        var result = latLongP.toString('d', 10).split(", ");
        var x = "-"+result[0].slice(1, 13);
        var y = result[1].slice(0, 14);
        var mymap = L.map('map').setView([x, y], 15);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWF1bGFuYWlhIiwiYSI6ImNrYnVidmdhdDAxbWgyc3Fjem8yeWx1cG4ifQ.45a-UzImpVNBUWd-TRt5qQ', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'your.mapbox.access.token'
        }).addTo(mymap);
        var marker = L.marker([x, y]).addTo(mymap);
        marker.bindPopup("<a href='https://www.google.com/maps/dir/?api=1&destination="+x+','+y+"' class='text-decoration-none text-dark'><b>"+nama+"</b><br/>"+jalan+"<br/><hr/>Buka di <b>GoogleMaps</b></a>");
    </script>
@endsection