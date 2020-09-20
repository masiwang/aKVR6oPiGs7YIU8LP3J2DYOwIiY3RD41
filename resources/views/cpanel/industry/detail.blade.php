@extends('cpanel._components.master')

@section('title')
    Dashboard
@endsection

@section('content')
    @include('cpanel._components.navigation')
    <div class="container">
        <div class="row">
            <div class="col-12 bg-white rounded shadow p-4">
                <h4 class="text-blue">{{ $perusahaan->badan_usaha }} {{ $perusahaan->nama_perusahaan }}</h4>
                <hr>
                <table class="table table-borderless table-hover">
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
                 @if ($user->role == 'operator')
                 <div class="row">
                    <div class="col-12 text-right">
                        <a  class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" style="width: 6rem">Hapus</a>
                        <a href="{{url('/admin/perusahaan/'.$perusahaan->perusahaan_id.'/edit')}}" class="btn btn-warning" style="width: 6rem">Edit</a>
                    </div>
                 </div>
                 @endif
            </div>
        </div>
    </div>
    @if($user->role == 'operator')
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ url('admin/perusahaan/'.$perusahaan->perusahaan_id.'/delete') }}" method="POST">
                    @csrf
                    <div class="modal-header bg-danger text-light">
                        <h5 class="modal-title" id="deleteModalLabel">Hapus perusahaan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Yakin menghapus {{ $perusahaan->badan_usaha }} {{ $perusahaan->nama_perusahaan }} dari database?
                        <input type="hidden" name="id" value="{{ $perusahaan->perusahaan_id }}">
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-secondary" data-dismiss="modal">Batal</a>
                        <button type="submit" class="btn btn-danger">Yakin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
    <div style="height: 4rem"></div>
    @include('cpanel._components.footer')
@endsection