@extends('cpanel._components.master')

@section('title')
    Dashboard
@endsection

@section('content')
    @include('cpanel._components.navigation')
    <div class="container">
        <div class="row">
            <div class="col-12 px-0">
                <div class="alert alert-danger mb-0" role="alert">
                    Maaf halaman yang Anda cari tidak ditemukan.
                </div>
            </div>
        </div>
    </div>
    <div style="height: 4rem"></div>
    @include('cpanel._components.footer')
@endsection