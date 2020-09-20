@extends('admin._master')

@section('title')
    Daftar Perusahaan
@endsection

@section('content')
    @include('admin.components._navbar')
    <div class="container mt-3">
        <div class="row">
            <div class="col d-flex justify-content-between">
                <h3 class="text-light">Tambah Admin Baru</h3>
            </div>
        </div>
        <hr style="background-color: #fff"/>
        <div class="row pt-2">
            <div class="col">
                <div class="card shadow mb-3 bg-white rounded">
                    <form action="{{url('admin/new')}}" method="POST">
                    @csrf
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
                                        <li class="list-group-item">
                                            <select class="form-select" name="role" aria-label="Default select example">
                                                <option value="pimpinan">Pimpinan</option>
                                                <option value="operator">Operator</option>
                                            </select>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstName" class="form-label">Nama Depan</label>
                                            <input type="text" value="" class="form-control" name="first_name" id="firstName" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="lastName" class="form-label">Nama Belakang</label>
                                            <input type="text" value="" class="form-control" name="last_name" id="lastName" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Ponsel</label>
                                            <input type="text" value="" class="form-control" name="phone" id="phone" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="old_email" autocomplete="no" value="" class="form-control" name="email" id="email" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="newPassword" class="form-label">Password Baru</label>
                                            <input type="password" class="form-control" name="new_password" id="newPassword" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
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
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection