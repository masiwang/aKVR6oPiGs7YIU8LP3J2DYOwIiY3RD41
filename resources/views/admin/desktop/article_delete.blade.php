@extends('_master')

@section('title')
    Dashboard
@endsection

@section('content')
    @include('admin.components._navbar')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card shadow bg-white rounded">
                    <form action="{{url('admin/article/'.$article->id.'/delete')}}" method="post">
                        @csrf
                        <div class="card-body">
                            Apakah anda yakin menghapus artikel "{{$article->title}}"?
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-danger" type="submit">
                                Hapus
                            </button>
                            <a class="btn btn-secondary" href="{{url('admin/article')}}">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div style="height: 4rem"></div>
    @include('admin.desktop._footer')
@endsection