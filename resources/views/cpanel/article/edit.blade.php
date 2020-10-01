@extends('cpanel._components.master')

@section('title')
    Dashboard
@endsection

@section('content')
    @include('cpanel._components.navigation')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-3 bg-white rounded">
                    <div class="card-body">
                        <h4 class="card-title text-blue">Edit Artikel</h4>
                        <hr>
                        <form action="{{url('admin/article/'.$article->id.'/edit')}}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $article->id }}">
                            <div class="mb-3">
                                <label for="articleTitle" class="form-label">Judul</label>
                                <input type="text" class="form-control" name="title" id="articleTitle" placeholder="Judul" value="{{$article->title}}">
                            </div>
                            <div class="mb-3">
                                <label for="articleTitle" class="form-label">Foto Artikel</label><br/>
                                <img src="{{asset($article->image_url)}}" style="max-height:200px"><br/>
                                <a class="btn btn-warning" data-toggle="modal" data-target="#exampleModal" data-id="{{$article->id}}">Ganti foto</a>
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" id="mytextarea" name="body" rows="13" placeholder="Isi artikel">{{$article->body}}</textarea>
                            </div>
                            <div class="text-right">
                                <a href="#" class="btn btn-secondary shadow rounded mr-2">Batal</a>
                                <button type="submit" class="btn btn-success shadow rounded">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{url('admin/article/'.$article->id.'/edit/image')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header bg-warning text-dark ">
                            <h5 class="modal-title" id="exampleModalLabel">Upload Foto Artikel Baru</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" value="{{ $article->id }}">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-secondary shadow rounded mr-2" data-dismiss="modal">Batal</a>
                            <button type="submit" class="btn btn-warning shadow rounded">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('cpanel._components.footer')
@endsection