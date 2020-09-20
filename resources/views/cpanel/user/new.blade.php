@extends('cpanel._components.master')

@section('title')
    Daftar Perusahaan
@endsection

@section('content')
@include('cpanel._components.navigation')
    <div class="container my-3">
        <div class="row">
            <div class="col d-flex justify-content-between">
                <h3 class="text-light">Tambah Admin Baru</h3>
            </div>
        </div>
        <hr style="background-color: #fff"/>
        <div class="row pt-2">
            <div class="col">
                <div class="card shadow mb-5 bg-white rounded">
                    <form action="{{url('admin/new')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="row">
                                    <span>Foto profil</span>
                                    <input type="file" class="form-control-file bg-warning" name="image" id="addSlideImage">
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
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th scope="row" width="20%" class="mt-auto">Nama</th>
                                            <td><input class="form-control form-control-sm" name="name" type="text"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Nomor Ponsel</th>
                                            <td><input class="form-control form-control-sm" name="phone" type="text"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Email</th>
                                            <td><input class="form-control form-control-sm" name="email" type="text"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Password Baru</th>
                                            <td><input class="form-control form-control-sm" name="password" type="text"></td>
                                        </tr>
                                    </tbody>
                                </table>
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
    @include('cpanel._components.footer')
@endsection