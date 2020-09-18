@extends('admin._master')

@section('title')
    Daftar Perusahaan
@endsection

@section('content')
    @include('admin.components._navbar')
    <div class="container mt-3">
        <div class="row">
            <div class="col d-flex justify-content-between">
                <h3 class="text-light">Profil</h3>
            </div>
        </div>
        <hr style="background-color: #fff"/>
        <div class="row pt-2">
            <div class="col">
                <div class="card shadow mb-3 bg-white rounded">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="row">
                                    <img src="/" style="width:100%; height:100%"/>
                                    <button class="btn btn-warning btn-sm w-100">Ganti foto</button>
                                </div>
                                <hr/>
                                <div class="row">
                                    <ul class="list-group">
                                        <li class="list-group-item active" aria-current="true">Role</li>
                                        <li class="list-group-item">{{ucwords($admin->role)}}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-sm-12">
                                        @if (\Session::has('success'))
                                            <div class="alert alert-success" role="alert">
                                                {{\Session::get('success')}}
                                            </div>
                                        @endif
                                        @if (\Session::has('error'))
                                            <div class="alert alert-danger" role="alert">
                                                {{\Session::get('error')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <form action="{{url('admin/profile/update')}}" method="POST">
                                    @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstName" class="form-label">Nama Depan</label>
                                            <input type="text" value="{{$admin->first_name}}" class="form-control" name="first_name" id="firstName" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="lastName" class="form-label">Nama Belakang</label>
                                            <input type="text" value="{{$admin->last_name}}" class="form-control" name="last_name" id="lastName" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Ponsel</label>
                                            <input type="text" value="{{$admin->phone}}" class="form-control" name="phone" id="phone" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="old_email" autocomplete="no" value="{{$admin->email}}" class="form-control" name="email" id="email" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="oldPassword" class="form-label">Password Lama</label>
                                            <input type="password" autocomplete="no" class="form-control" name="old_password" id="oldPassword" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="newPassword" class="form-label">Password Baru</label>
                                            <input type="password" class="form-control" name="new_password" id="newPassword" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="newPassword2" class="form-label">Konfirmasi Password Baru</label>
                                            <input type="password" class="form-control" name="new_password_2" id="newPassword2" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 text-right">
                                        <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                                    </div>
                                </div>
                                </form>
                                <hr/>
                                <div class="row">
                                    <p class="text-primary"><b>Aktivitas terakhir Anda</b></p>
                                    <div class="col-sm-12">
                                        <table class="table table-borderless">
                                            <thead>
                                                <tr>
                                                    <th width="20%">Waktu</th>
                                                    <th>Aktivitas</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($activity as $a)
                                                <tr>
                                                    <td>
                                                        {{$a->created_at}}
                                                    </td>
                                                    <td>
                                                        {{ucwords($a->action)}} {{ucwords($a->object)}} {{ucwords($a->name)}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 text-right">
                                        <a class="btn btn-primary btn-sm" href="{{url('admin/logs')}}">Lihat semua aktivitas</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection