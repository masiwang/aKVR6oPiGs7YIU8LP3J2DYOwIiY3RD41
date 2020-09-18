@extends('_master')

@section('title')
    Dashboard
@endsection

@section('content')
    @include('admin.components._navbar')
    <div class="container">
        <div class="row">
            <div class="col-12 bg-white rounded shadow p-4">
                <form action="{{url('admin/perusahaan/'.$perusahaan->id.'/edit_save')}}" method="POST">
                    @csrf
                    <h4 class="text-blue">Edit Perusahaan</h4>
                    <hr>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td><b>Foto Perusahaan</b></td>
                            <td><img src="{{asset($perusahaan->file_foto)}}" alt="" srcset="" style="max-height: 150px"><br>
                                <a class="btn btn-warning mt-2 btn-sm" data-toggle="modal" data-target="#exampleModal" data-id="{{$perusahaan->id}}">Ganti foto</a></td>
                        <tr>
                        <tr>
                            <td><b>Tahun Data</b></td>
                            <td><input type="number" name="tahun_data" value="{{$perusahaan->tahun_data}}" class="table-input"></td>
                        <tr>
                            <td style="width: 20%"><b>Badan Usaha</b></td>
                            <td><input type="text" name="badan_usaha" value="{{$perusahaan->badan_usaha}}" class="table-input"></td>
                        <tr>
                            <td><b>Nama Perusahaan</b></td>
                            <td><input type="text" name="nama_perusahaan" value="{{$perusahaan->nama_perusahaan}}" class="table-input"></td>
                        <tr>
                            <td><b>Nama Pemilik</b></td>
                            <td><input type="text" name="nama_pemilik" value="{{$perusahaan->nama_pemilik}}" class="table-input"></td>
                        <tr>
                            <td><b>Alamat Perusahaan</b></td>
                            <td><input type="text" name="jalan" value="{{$perusahaan->jalan}}" class="table-input"></td>
                        <tr>
                            <td><b>Kelurahan</b></td>
                            <td><input type="text" name="kelurahan" value="{{$perusahaan->kelurahan}}" class="table-input"></td>
                        </tr>
                        <tr>
                            <td><b>Kecamatan</b></td><td><input type="text" name="kecamatan" value="{{$perusahaan->kecamatan}}" class="table-input"></td>
                        </tr>
                        <tr>
                        <tr>
                            <td><b>Latitude</b></td><td><input type="number" name="latitude" value="{{$perusahaan->latitude}}" class="table-input"></td>
                        </tr>
                        <tr>
                            <td><b>Longitude</b></td><td><input type="number" name="longitude" value="{{$perusahaan->longitude}}" class="table-input"></td>
                        </tr>
                        <tr>
                            <td><b>Telepon</b></td><td><input type="text" name="telepon" value="{{$perusahaan->telepon}}" class="table-input"></td>
                        </tr>
                        <tr>
                            <td><b>Fax</b></td><td><input type="text" name="fax" value="{{$perusahaan->fax}}" class="table-input"></td>
                        </tr>
                        <tr>
                            <td><b>Email</b></td><td><input type="text" name="email" value="{{$perusahaan->email}}" class="table-input"></td>
                        </tr>
                        <tr>
                            <td><b>Website</b></td><td><input type="text" name="website" value="{{$perusahaan->website}}" class="table-input"></td>
                        </tr>
                        <tr>
                            <td><b>Izin Usaha</b></td><td><input type="text" name="izin_usaha" value="{{$perusahaan->izin_usaha}}" class="table-input"></td>
                        </tr>
                        <tr>
                            <td><b>Tahun Izin</b></td><td><input type="number" name="tahun_izin" value="{{$perusahaan->tahun_izin}}" class="table-input"></td>
                        </tr>
                        <tr>
                            <td><b>KBLI</b></td><td><input type="text" name="kbli" value="{{$perusahaan->kbli}}" class="table-input"></td>
                        </tr>
                        <tr>
                            <td><b>NIK</b></td><td><input type="text" name="nik" value="{{$perusahaan->nik}}" class="table-input"></td>
                        </tr>
                        <tr>
                            <td><b>Skala Industri</b></td><td><input type="text" name="skala_industri" value="{{$perusahaan->skala_industri}}" class="table-input"></td>
                        </tr>
                        <tr>
                            <td><b>Karyawan Laki-laki</b></td><td><input type="number" name="karyawan_laki" value="{{$perusahaan->karyawan_laki}}" class="table-input"></td>
                        </tr>
                        <tr>
                            <td><b>Karyawan Perempuan</b></td><td><input type="number" name="karyawan_perempuan" value="{{$perusahaan->karyawan_perempuan}}" class="table-input"></td>
                        </tr>
                        <tr>
                            <td><b>Tipe Industri</b></td><td><input type="text" name="tipe_industri" value="{{$perusahaan->tipe_industri}}" class="table-input"></td>
                        </tr>
                        <tr>
                            <td><b>Jenis Produk</b></td><td><input type="text" name="jenis_produk" value="{{$perusahaan->jenis_produk}}" class="table-input"></td>
                        </tr>
                        <tr>
                            <td><b>Komoditas</b></td><td><input type="text" name="komoditas" value="{{$perusahaan->komoditas}}" class="table-input"></td>
                        </tr>
                        <tr>
                            <td><b>Bahan Baku Utama</b></td><td><input type="text" name="bahan_baku_utama" value="{{$perusahaan->bahan_baku_utama}}" class="table-input"></td>
                        </tr>
                        <tr>
                            <td><b>Nilai Bahan Baku</b></td><td><input type="number" name="nilai_bahan_baku" value="{{$perusahaan->nilai_bahan_baku}}" class="table-input"></td>
                        </tr>
                        <tr>
                            <td><b>Bahan Penolong</b></td><td><input type="number" name="nilai_bahan_penolong" value="{{$perusahaan->nilai_bahan_penolong}}" class="table-input"></td>
                        </tr>
                        <tr>
                            <td><b>Jumlah Kapasitas Produksi</b></td><td><input type="number" name="jumlah_kapasitas_produksi" value="{{$perusahaan->jumlah_kapasitas_produksi}}" class="table-input"></td>
                        </tr>
                        <tr>
                            <td><b>Satuan Kapasitas Produksi</b></td><td><input type="text" name="satuan_kapasitas_produksi" value="{{$perusahaan->satuan_kapasitas_produksi}}" class="table-input"></td>
                        </tr>
                        <tr>
                            <td><b>Nilai Produksi</b></td><td><input type="number" name="nilai_produksi" value="{{$perusahaan->nilai_produksi}}" class="table-input"></td>
                        </tr>
                        <tr>
                            <td><b>Nilai Investasi</b></td><td><input type="number" name="nilai_investasi" value="{{$perusahaan->nilai_investasi}}" class="table-input"></td>
                        </tr>
                        <tr>
                            <td><b>Wilayah Pemasaran</b></td><td><input type="text" name="wilayah_pemasaran" value="{{$perusahaan->wilayah_pemasaran}}" class="table-input"></td>
                        </tr>
                        <tr>
                            <td><b>Negara Tujuan Eksport</b></td><td><input type="text" name="negara_tujuan_export" value="{{$perusahaan->negara_tujuan_export}}" class="table-input"></td>
                        </tr>
                        <tr>
                            <td><b>Energi yang Digunakan</b></td><td><input type="text" name="energi" value="{{$perusahaan->energi}}" class="table-input"></td>
                        </tr>
                        <tr>
                            <td><b>Limbah yang Dihasilkan</b></td><td><input type="text" name="limbah_dihasilkan" value="{{$perusahaan->limbah_dihasilkan}}" class="table-input"></td>
                        </tr>
                        <tr>
                            <td><b>Jumlah Limbah</b></td><td><input type="number" name="jumlah_limbah" value="{{$perusahaan->jumlah_limbah}}" class="table-input"></td>
                        </tr>
                        <tr>
                            <td><b>Satuan Limbah</b></td><td><input type="text" name="satuan_limbah" value="{{$perusahaan->satuan_limbah}}" class="table-input"></td>
                        </tr>
                        <tr>
                            <td><b>Olahan Limbah</b></td><td><input type="text" name="olahan_limbah" value="{{$perusahaan->olahan_limbah}}" class="table-input"></td>
                        </tr>
                    </tbody>
                 </table>
                 <div class="row">
                    <div class="col-12 text-right">
                        <a class="btn btn-secondary" style="width: 6rem">Kembali</a>
                        <button type="submit" class="btn btn-primary" id="buttonSimpan" style="width: 6rem">Simpan</button>
                    </div>
                 </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{url('admin/perusahaan/'.$perusahaan->id.'/edit_image')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header bg-primary text-light ">
                        <h5 class="modal-title" id="exampleModalLabel">Upload Foto Perusahaan Baru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="addSlideImage" class="form-label">Foto Perusahaan</label><br/>
                        <input type="file" class="form-control-file" name="file">
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary shadow rounded mr-2">Batal</a>
                        <button type="submit" class="btn btn-primary shadow rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div style="height: 4rem"></div>
    @include('admin.desktop._footer')
    <script>var latitude=document.querySelector('input[name="latitude"'),longitude=document.querySelector('input[name="longitude"'),buttonSimpan=document.querySelector("#buttonSimpan");latitude.addEventListener("change",function(){this.value<474e3||this.value>486e3?(alert("Nilai latitude anda salah!\nNilai latitude harus diantara 474000 hingga 486000"),buttonSimpan.setAttribute("disabled",!0)):buttonSimpan.removeAttribute("disabled",!0)}),longitude.addEventListener("change",function(){this.value<916e4||this.value>9169e3?(alert("Nilai longitude anda salah!\nNilai longitude harus diantara 9160000 hingga 9169000"),buttonSimpan.setAttribute("disabled",!0)):buttonSimpan.removeAttribute("disabled",!0)});</script>
@endsection