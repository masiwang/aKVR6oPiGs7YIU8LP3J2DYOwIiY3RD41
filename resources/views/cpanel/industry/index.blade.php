@extends('cpanel._components.master')

@section('title')
    Daftar Perusahaan
@endsection

@section('content')
    @include('cpanel._components.navigation')
    <div class="container">
        <div class="row pt-2">
            <div class="col-12">
                @if (\Session::has('success'))
                <div class="card shadow bg-white rounded">
                    <div class="alert alert-success mb-0" role="alert">
                        {{\Session::get('success')}}
                    </div>
                </div>
                <div style="height: 1rem"></div>
                @endif
                <div class="card shadow bg-white rounded">
                    <div class="card-body pb-0">
                        <form class="row g-2">
                            <div class="col-2">
                                <input type="text" class="form-control form-control-sm" name="perusahaan" value="{{Request::get('perusahaan')}}" placeholder="Nama Perusahaan">
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control form-control-sm" name="kelurahan" value="{{Request::get('kelurahan')}}" placeholder="Kelurahan">
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control form-control-sm" name="kecamatan" value="{{Request::get('kecamatan')}}" placeholder="Kecamatan">
                            </div>
                            <div class="col-2">
                                <select class="form-select form-select-sm" name="tipe" aria-label=".form-select-sm example">
                                    <option value="">Semua</option>
                                    <option value="1" @if(Request::get('tipe')==1) selected @endif>Agro dan Aneka Pangan</option>
                                    <option value="2" @if(Request::get('tipe')==2) selected @endif>Aneka Usaha Industri</option>
                                    <option value="3" @if(Request::get('tipe')==3) selected @endif>Tekstil dan Produk Tekstil</option>
                                  </select>
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control form-control-sm" name="komoditas" value="{{Request::get('komoditas')}}" placeholder="Komoditas">
                            </div>
                            <div class="col-1">
                                <button type="submit" class="btn btn-primary btn-sm mb-3 w-100">Cari</button>
                            </div>
                            <div class="col-1">
                                <a href="{{
                                 url(
                                     'admin/perusahaan/download?'
                                     .'perusahaan='.\Request::get('perusahaan')
                                     .'&kelurahan='.\Request::get('kelurahan')
                                     .'&kecamatan='.\Request::get('kecamatan')
                                     .'&tipe='.\Request::get('tipe')
                                     .'&komoditas='.\Request::get('komoditas'))
                                }}" class="btn btn-success btn-sm mb-3 w-100">Eksport</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div style="height: 1rem"></div>
                <div class="card shadow bg-white rounded" style="height:auto">
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-hover table-sm" style="font-size: .7rem">
                            <thead class="text-primary">
                                <th width="15%" class="text-center">Nama Industri</th>
                                <th width="10%" class="text-center">Pemilik</th>
                                <th width="8%" class="text-center">Telepon</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Tipe</th>
                                <th class="text-center">Komoditas</th>
                                <th width="5%" class="text-center">Karyawan</th>
                                <th  class="text-center" width="5%">&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($perusahaans as $perusahaan)
                                <tr id="perusahaan-{{$perusahaan->id}}">
                                    <td>{{ $perusahaan->badan_usaha }} {{$perusahaan->nama_perusahaan}}</td>
                                    <td>{{$perusahaan->nama_pemilik}}</td>
                                    <td>{{$perusahaan->telepon}}</td>
                                    <td>{{$perusahaan->jalan}}, {{$perusahaan->kelurahan}}, {{$perusahaan->kecamatan}}</td>
                                    <td>{{$perusahaan->tipe_industri}}</td>
                                    <td>{{$perusahaan->komoditas}}</td>
                                    <td>L: {{$perusahaan->karyawan_laki}}<br/>P: {{$perusahaan->karyawan_perempuan}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-info" href="{{url('/admin/perusahaan/'.$perusahaan->id.'/detail')}}">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div style="height: 1rem"></div>
                <div class=" d-flex justify-content-center mb-5">
                    {{$perusahaans->appends(request()->input())->links()}}
                </div>
            </div>
        </div>
    </div>
    @include('cpanel._components.footer')
@endsection