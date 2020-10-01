@extends('cpanel._components.master')

@section('title')
    Dashboard
@endsection

@section('content')
    @include('cpanel._components.navigation')
    <div class="container">
        <div class="row">
            <div class="col">
                <h3 class="text-success">Daftar Admin</h3>
            </div>
        </div>
        <hr class="d-none d-md-block" style="background-color: #fff"/>
        <div class="row mb-3 mb-md-5">
            <div class="col">
                <div class="card shadow mb-3 bg-white rounded" style="height:400px">
                    <div class="card-body table-responsive">
                        <table class="table table-hover table-sm">
                            <thead class="bg-lignt text-success">
                                <th width="20%">Email</th>
                                <th>Nama</th>
                                <th>
                                    <div class="dropdown">
                                        <a class="font-weight-bold text-decoration-none dropdown-toggle text-success" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                            Role
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li><a class="dropdown-item" href="?role=">Semua</a></li>
                                            <li><a class="dropdown-item" href="?role=Pimpinan">Pimpinan</a></li>
                                            <li><a class="dropdown-item" href="?role=Operator">Operator</a></li>
                                        </ul>
                                    </div>
                                </th>
                                <th>Waktu Registrasi</th>
                            </thead>
                            <tbody>
                                @foreach($admins as $admin)
                                    <tr>
                                        <td>{{$admin->email}}</td>
                                        <td>{{$admin->name}}</td>
                                        <td>{{ucwords($admin->role)}}</td>
                                        <td>{{$admin->created_at}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('cpanel._components.footer')
@endsection