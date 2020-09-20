@extends('cpanel._components.master')

@section('title')
    Daftar Perusahaan
@endsection

@section('content')
    @include('cpanel._components.navigation')
    <div class="container mt-3">
        <div class="row">
            <div class="col d-flex justify-content-between">
                <h3 class="text-light">Profil {{ $user->name }}</h3>
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
                                    <img src="{{ asset($user->image) }}" style="width:100%; height:100%"/>
                                    <button class="btn btn-warning btn-sm w-100" data-toggle="modal" data-target="#updateImage">Ganti foto</button>
                                </div>
                                <hr/>
                                <div class="row">
                                    <ul class="list-group">
                                        <li class="list-group-item active" aria-current="true">Role</li>
                                        <li class="list-group-item">{{ucwords($user->role)}}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="text-primary"><b>Update profile</b></p>
                                        <form action="{{ url('/admin/profile/update') }}" method="post">
                                            @csrf
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row" width="20%" class="mt-auto">Nama</th>
                                                        <td><input class="form-control form-control-sm" name="name" type="text" value="{{ $user->name }}"></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Nomor Ponsel</th>
                                                        <td><input class="form-control form-control-sm" name="phone" type="text" value="{{ $user->phone }}"></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Email</th>
                                                        <td><input class="form-control form-control-sm" name="email" type="text" value="{{ $user->email }}"></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Password Baru</th>
                                                        <td><input class="form-control form-control-sm" name="password" type="text"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="text-right">
                                                <button class="btn btn-primary btn-sm">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

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
                                                @foreach ($logs as $log)
                                                <tr>
                                                    <td>
                                                        {{$log->created_at}}
                                                    </td>
                                                    <td>
                                                        {{ucwords($log->action)}} {{ucwords($log->object)}} {{ucwords($log->name)}}
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
    <div class="modal fade" id="updateImage" tabindex="-1" aria-labelledby="updateImageLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ url('/admin/profile/update/image') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <p class="mb-1"><b>Pilih file foto profil baru:</b></p>
                        <div class="form-file">
                            <input type="file" name="image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('cpanel._components.footer')
@endsection