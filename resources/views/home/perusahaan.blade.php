@extends('_master')

@section('title')
    Home
@endsection

@section('content')
@include('home/_navbar')
<div class="container mt-3">
    <div class="row">
        <div class="col d-flex justify-content-between">
            <h3 class="text-light">Daftar Perusahaan</h3>
        </div>
    </div>
    <hr style="background-color: #fff"/>
    <div class="row pt-2">
        <div class="col">
            @if (\Session::has('success'))
            <div class="card shadow mb-3 bg-white rounded">
                <div class="alert alert-success mb-0" role="alert">
                    {{\Session::get('success')}}
                </div>
            </div>
            @endif
            <div class="card shadow mb-3 bg-white rounded">
                <div class="card-body pb-0">
                    <form class="row g-2">
                        <div class="col-lg-auto col-sm-12">
                            <input type="text" class="form-control form-control-sm" name="industri" value="{{Request::get('industri')}}" placeholder="Nama Perusahaan">
                        </div>
                        <div class="col-lg-auto col-sm-12">
                            <input type="text" class="form-control form-control-sm" name="kelurahan" value="{{Request::get('kelurahan')}}" placeholder="Kelurahan">
                        </div>
                        <div class="col-lg-auto col-sm-12">
                            <input type="text" class="form-control form-control-sm" name="kecamatan" value="{{Request::get('kecamatan')}}" placeholder="Kecamatan">
                        </div>
                        <div class="col-lg-auto col-sm-12">
                            <select class="form-select form-select-sm" name="tipe" aria-label=".form-select-sm example">
                                <option value="">Semua</option>
                                <option value="1" @if(Request::get('tipe')==1) selected @endif>Agro dan Aneka Pangan</option>
                                <option value="2" @if(Request::get('tipe')==2) selected @endif>Aneka Usaha Industri</option>
                                <option value="3" @if(Request::get('tipe')==3) selected @endif>Tekstil dan Produk Tekstil</option>
                              </select>
                        </div>
                        <div class="col-lg-auto col-sm-12">
                            <input type="text" class="form-control form-control-sm" name="komoditas" value="{{Request::get('komoditas')}}" placeholder="Komoditas">
                        </div>
                        <div class="col-lg-auto col-sm-12">
                            <button type="submit" class="btn btn-primary btn-sm mb-3">Cari</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card shadow mb-3 bg-white rounded" style="height:auto">
                <div class="card-body table-responsive">
                    <table class="table table-hover table-sm table-industri">
                        <thead class="text-primary">
                            <th width="15%">Nama Industri</th>
                            <th>Alamat</th>
                            <th>Tipe</th>
                            <th>Komoditas</th>
                        </thead>
                        <tbody>
                            @foreach ($perusahaan as $p)
                            <tr>
                                <td>{{$p->badan_usaha}} {{$p->nama_perusahaan}}</td>
                                <td>{{$p->jalan}}, {{$p->kelurahan}}, {{$p->kecamatan}}</td>
                                <td>{{$p->tipe_industri}}</td>
                                <td>{{$p->komoditas}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class=" d-flex justify-content-center mb-5">
                {{$perusahaan->appends(request()->input())->links()}}
            </div>
        </div>
    </div>
</div>
@endsection