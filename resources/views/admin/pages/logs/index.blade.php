@extends('admin._master')

@section('title')
    Dashboard
@endsection

@section('content')
    @include('admin.components._navbar')
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h3 class="text-light">Log Aktivitas Admin</h3>
            </div>
        </div>
        <hr style="background-color: #fff"/>
        <div class="row pt-2">
            <div class="col">
                <div class="card shadow mb-3 bg-white rounded" style="height:400px">
                    <div class="card-body table-responsive">
                        <table class="table table-hover table-sm">
                            <thead class="bg-lignt text-primary">
                                <th width="20%">Tanggal</th>
                                <th>Admin</th>
                                <th>
                                    <div class="dropdown">
                                        <a class="font-weight-bold text-decoration-none dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                            Aktivitas
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li><a class="dropdown-item" href="?aktivitas=">Semua</a></li>
                                            <li><a class="dropdown-item" href="?aktivitas=Buat">Buat</a></li>
                                            <li><a class="dropdown-item" href="?aktivitas=Edit">Edit</a></li>
                                            <li><a class="dropdown-item" href="?aktivitas=Hapus">Hapus</a></li>
                                        </ul>
                                    </div>
                                </th>
                                <th>
                                    <div class="dropdown">
                                        <a class="font-weight-bold text-decoration-none dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                            Objek
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li><a class="dropdown-item" href="?objek=">Semua</a></li>
                                            <li><a class="dropdown-item" href="?objek=Artikel">Artikel</a></li>
                                            <li><a class="dropdown-item" href="?objek=Industri">Industri</a></li>
                                        </ul>
                                    </div>
                                </th>
                                <th>Nama</th>
                            </thead>
                            <tbody>
                                @foreach($logs as $log)
                                    <tr>
                                        <td>{{$log->created_at}}</td>
                                        <td>Admin {{$log->user_id}}</td>
                                        <td>{{$log->action}}</td>
                                        <td>{{$log->object}}</td>
                                        <td>{{$log->name}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class=" d-flex justify-content-center mb-5">
                    {{$logs->links()}}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-light">
                    <h5 class="modal-title" id="staticBackdropLabel">Perhatian!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <p>Apakah Anda yakin menghapus industri ? Proses tidak dapat dibatalkan.</p>
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-light mr-1 shadow" data-dismiss="modal">Batal</a>
                            <button type="button" class="btn btn-danger shadow">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection