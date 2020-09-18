@extends('admin._master')

@section('title')
    Dashboard
@endsection

@section('content')
    @include('admin.components._navbar')
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h3 class="text-light">Edit Artikel</h3>
            </div>
        </div>
        <hr style="background-color: #fff"/>
        <div class="row">
            <div class="col">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
        <div class="row pt-2">
            <div class="col">
                <form action="{{url('admin/article/'.$article->id.'/edit')}}" method="post">
                    @csrf
                    <input name="_method" type="hidden" value="PUT">
                    <div class="card shadow mb-3 bg-white rounded">
                        <div class="card-body">
                            <label for="Title" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="Title" name="title" placeholder="Judul" value="{{$article->title}}">
                        </div>
                    </div>
                    <div class="card shadow mb-3 bg-white rounded">
                        <div class="card-body">
                            <img src="{{asset($article->image_url)}}" style="max-height:200px" alt=""><br/>
                            <a class="btn btn-warning" data-toggle="modal" data-target="#exampleModal" data-id="{{$article->id}}">Ganti foto</a>
                        </div>
                    </div>
                    <div class="card shadow mb-3 bg-white rounded" style="height:auto">
                        <div class="card-body table-responsive">
                            <label for="Title" class="form-label">Text</label>
                            <textarea class="form-control" name="body" rows="13" placeholder="Isi artikel">{{$article->body}}</textarea>
                            <small class="text-primary">*TIPS: Tulis dengan bahasa HTML</small>
                        </div>
                    </div>
                    <div class="mb-5 d-flex justify-content-end">
                        <div>
                            <a href="#" class="btn btn-secondary shadow rounded mr-2">Batal</a>
                            <button type="submit" class="btn btn-primary shadow rounded">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{url('admin/article/'.$article->id.'/edit/image')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-warning text-light ">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Foto Artikel Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="addSlideImage" class="form-label">Foto Artikel</label><br/>
                    <input type="file" class="form-control-file" name="file">
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary shadow rounded mr-2">Batal</a>
                    <button type="submit" class="btn btn-warning shadow rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection