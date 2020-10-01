@extends('cpanel._components.master')

@section('title')
    Dashboard
@endsection

@section('content')
    @include('cpanel._components.navigation')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card shadow bg-white rounded">
                    <div class="card-body pb-0">
                        <form class="row">
                            <div class="col-12 d-flex">
                                <div class="flex-grow-1 pr-md-2">
                                    <input type="text" name="title" class="form-control form-control-sm" placeholder="Judul">
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-success btn-sm mb-3">Cari</button>
                                </div>
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
                                    <a href="{{ url('admin/article/'.$article->id) }}" class="text-decoration-none text-success"><b>{{$article->title}}</b><br/></a>
                                    <small style="font-size: .7rem">Admin {{$article->author}} - <i>{{ \Carbon\Carbon::parse($article->created_at)->format('j F Y : H.m') }}</i></small><br/>
                                    <p class="mb-0">{!!substr($article->body, 0, 200)!!}</p><br/>
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
    @include('cpanel._components.footer')
@endsection