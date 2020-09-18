@extends('_master')

@section('title')
    Dashboard
@endsection

@section('content')
    @include('admin.components._navbar')
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div style="height: 1rem"></div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-3 bg-white rounded">
                    <div class="card-body">
                        <h4 class="card-title text-blue">Tambah artikel baru</h4>
                        <hr>
                        <form action="{{url('admin/article/create')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="articleTitle" class="form-label">Judul</label>
                                <input type="text" class="form-control" name="title" id="articleTitle" placeholder="Judul">
                            </div>
                            <div class="mb-3">
                                <label for="addSlideImage" class="form-label">Foto</label><br/>
                                <input type="file" class="form-control-file" name="file" id="addSlideImage">
                            </div>
                            <div class="mb-3">
                                <label for="Title" class="form-label">Isi</label>
                                <textarea class="form-control" name="body" rows="13" placeholder="Isi artikel"></textarea>
                            </div>
                            <div class="text-right">
                                <a href="#" class="btn btn-secondary shadow rounded mr-2">Batal</a>
                                <button type="submit" class="btn btn-primary shadow rounded">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="height: 4rem"></div>
    @include('admin.desktop._footer')
@endsection