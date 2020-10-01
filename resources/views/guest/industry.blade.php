@extends('guest._components.master')

@section('title')
    Perusahaan
@endsection

@section('content')
@include('guest._components.top_nav')
<div class="container" style="margin-top: 80px">
    <div class="row pt-2">
        <div class="col-12">
            <div class="card shadow bg-white rounded">
                <div class="card-body pb-0">
                    <form class="row g-2 p-3 pt-0">
                        <div class="col-12 col-md-2">
                            <input type="text" class="form-control form-control-sm" name="perusahaan" value="{{Request::get('perusahaan')}}" placeholder="Nama Perusahaan">
                        </div>
                        <div class="col-12 col-md-2">
                            <input type="text" class="form-control form-control-sm" name="kelurahan" value="{{Request::get('kelurahan')}}" placeholder="Kelurahan">
                        </div>
                        <div class="col-12 col-md-2">
                            <input type="text" class="form-control form-control-sm" name="kecamatan" value="{{Request::get('kecamatan')}}" placeholder="Kecamatan">
                        </div>
                        <div class="col-12 col-md-2">
                            <select class="form-select form-select-sm" name="tipe" aria-label=".form-select-sm example">
                                <option value="">Semua</option>
                                <option value="1" @if(Request::get('tipe')==1) selected @endif>Agro dan Aneka Pangan</option>
                                <option value="2" @if(Request::get('tipe')==2) selected @endif>Aneka Usaha Industri</option>
                                <option value="3" @if(Request::get('tipe')==3) selected @endif>Tekstil dan Produk Tekstil</option>
                              </select>
                        </div>
                        <div class="col-12 col-md-2">
                            <input type="text" class="form-control form-control-sm" name="komoditas" value="{{Request::get('komoditas')}}" placeholder="Komoditas">
                        </div>
                        <div class="col-12 col-md-1">
                            <button type="submit" class="btn btn-primary btn-sm w-100">Cari</button>
                        </div>
                    </form>
                </div>
            </div>
            <div style="height: 1rem"></div>
            <div class="card shadow bg-white rounded" style="height:auto">
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover table-sm" style="font-size: .7rem">
                        <thead class="text-success">
                            <th width="15%" class="text-center">Nama Industri</th>
                            <th class="text-center">Alamat</th>
                            <th class="text-center">Tipe</th>
                            <th class="text-center">Komoditas</th>
                        </thead>
                        <tbody>
                            @foreach ($perusahaans as $perusahaan)
                            <tr id="perusahaan-{{$perusahaan->id}}">
                                <td>{{ $perusahaan->badan_usaha }} {{$perusahaan->nama_perusahaan}}</td>
                                <td>{{$perusahaan->jalan}}, {{$perusahaan->kelurahan}}, {{$perusahaan->kecamatan}}</td>
                                <td>{{$perusahaan->tipe_industri}}</td>
                                <td>{{$perusahaan->komoditas}}</td>
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
@include('guest._components.footer')
@endsection