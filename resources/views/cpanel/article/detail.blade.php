@extends('cpanel._components.master')

@section('title')
    Artikel - {{$article->title}}
@endsection

@section('content')
    @include('cpanel._components.navigation')
    <div class="container">
        <div class="row pt-2 mb-3 mb-md-5">
            <div class="col">
                <div class="card shadow mb-3 bg-white rounded">
                    <div class="card-body">
                        <h3>{{ $article->title }}</h3>
                        <hr>
                        <img src="{{asset($article->image_url)}}" alt="" srcset="" style="max-height:20rem">
                        <div style="height:1rem"></div>
                        <p><small>Ditulis oleh: Admin {{ $user->id }} | {{ \Carbon\Carbon::parse($article->created_at)->format('j F Y - H:m') }}</small></p>
                        {!! $article->body !!}
                        <hr>
                        @if ($user->role=='operator')
                        <div class="row">
                            <div class="col-12 text-right">
                                <button  class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Hapus</button>
                                <a href="{{ url('admin/article/'.$article->id.'/edit') }}" class="btn btn-warning">Edit</a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ url('admin/article/'.$article->id.'/delete') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Hapus Artikel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Anda yakin menghapus artikel {{ $article->title }}?
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-secondary" data-dismiss="modal">Batal</a>
                        <button type="submit" class="btn btn-danger">Ya</button>
                    </div>
                </form>
            </div>
        </div>
      </div>
    @include('cpanel._components.footer')
@endsection