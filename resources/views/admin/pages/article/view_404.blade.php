@extends('admin._master')

@section('title')
    Artikel - 
@endsection

@section('content')
    @include('admin.components._navbar')
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h3 class="text-light">Artikel tidak ditemukan</h3>
            </div>
        </div>
    </div>
@endsection