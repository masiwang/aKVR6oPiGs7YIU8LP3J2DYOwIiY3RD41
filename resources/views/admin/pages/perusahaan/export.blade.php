@extends('admin._master')

@section('title')
    Dashboard
@endsection

@section('content')
    @include('admin.components._navbar')
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h3 class="text-light">Eksport Industri</h3>
            </div>
        </div>
        <hr/>
        <div class="row pt-4">
            <div class="card shadow mb-3 bg-white rounded">
                <div class="card-body pb-0">
                    <form class="row g-2 pt-3" action="{{url('admin/perusahaan/export/xlsx')}}">
                        
                        <div class="row mb-3">
                            <input type="number" class="form-control " name="industri" value="{{Request::get('industri')}}" placeholder="Tahun data">
                        </div>
                        <div class="row mb-3">
                            <select class="form-select " name="tipe" aria-label=".form-select-sm example">
                                <option value="">Semua</option>
                                <option value="1" @if(Request::get('tipe')==1) selected @endif>Agro dan Aneka Pangan</option>
                                <option value="2" @if(Request::get('tipe')==2) selected @endif>Aneka Usaha Industri</option>
                                <option value="3" @if(Request::get('tipe')==3) selected @endif>Tekstil dan Produk Tekstil</option>
                              </select>
                        </div>
                        <div class="row mb-3">
                            <input type="text" class="form-control " name="kelurahan" value="{{Request::get('kelurahan')}}" placeholder="Kelurahan">
                        </div>
                        <div class="row mb-3">
                            <input type="text" class="form-control " name="kecamatan" value="{{Request::get('kecamatan')}}" placeholder="Kecamatan">
                        </div>
                        <div class="row mb-2">
                            <button type="submit" class="btn btn-primary mb-3">Cari</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection

