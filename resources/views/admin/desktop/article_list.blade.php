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
                    <div class="card-body pb-0">
                        <form class="row g-2">
                            <div class="col-auto">
                                <input type="text" class="form-control form-control-sm" id="inputPassword2" placeholder="Judul">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary btn-sm mb-3">Cari</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div style="height: 1rem"></div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow bg-white rounded">
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            @foreach($articles as $article)
                            <tr>
                                <td style="width: 10%">
                                    <img src="{{asset($article->image_url)}}" style="height: 80px; width: 80px" alt="">
                                </td>
                                <td style="width: 90%">
                                    <b>{{$article->title}}</b><br/>
                                    <small style="font-size: .7rem">Admin {{$article->author}} - <i>{{$article->created_at}}</i></small><br/>
                                    <p class="mb-0">{{substr($article->body, 0, 200)}}...</p><br/>
                                    @if (Session::get('role') == 'operator')
                                    <p>
                                        <a href="{{url('admin/article/'.$article->id)}}" class="btn btn-sm btn-info">
                                            Lihat
                                        </a>
                                        <a href="{{url('admin/article/'.$article->id.'/edit')}}" class="btn btn-sm btn-warning">
                                            Edit
                                        </a>
                                        <a href="{{url('admin/article/'.$article->id.'/delete')}}" class="btn btn-danger btn-sm">
                                            Hapus
                                        </a>
                                    </p>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class=" d-flex justify-content-center">
                    {{$articles->links()}}
                </div>
            </div>
        </div>
    </div>
    <div style="height: 4rem"></div>
    @include('admin.desktop._footer')
@endsection