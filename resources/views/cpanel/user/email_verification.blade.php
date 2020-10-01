@extends('cpanel._components.master')

@section('title')
    Dashboard
@endsection

@section('content')
    @include('cpanel._components.navigation')
    <div class="container my-5">
        <div class="row">
            <div class="col">
                <h3 class="text-dark">Verifikasi Email Anda terlebih dahulu.</h3>
            </div>
        </div>
        <hr style="background-color: #fff"/>
        <div class="row pt-2">
            <div class="col">
                <div class="card shadow mb-3 bg-white rounded">
                    @if (\Session::has('success'))
                    <div class="card-body table-responsive">
                        Cek email Anda untuk mengakses token verifikasi.
                    </div>
                    @else
                    <div class="card-body table-responsive">
                        Klik tombol dibawah ini untuk mengirim token verifikasi email.<br>
                        <a class="btn btn-success" href="{{ url('admin/send_email_token') }}">Verifikasi sekarang</a>
                    </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
    @include('cpanel._components.footer')
@endsection