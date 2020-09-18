@extends('_master')

@section('title')
    Artikel - {{$article->title}}
@endsection

@section('content')
    @include('admin.components._navbar')
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h3 class="text-light">{{$article->title}}</h3>
            </div>
        </div>
        <hr style="background-color: #fff"/>
        <div class="row pt-2">
            <div class="col">
                <div class="card shadow mb-3 bg-white rounded">
                    <div class="card-body text-center" style="height: 30rem">
                        <img src="{{asset($article->image_url)}}" alt="" srcset="" style="height:100%">
                    </div>
                </div>
                <div class="card shadow mb-3 bg-white rounded" style="height:400px">
                    <div class="card-body table-responsive">
                        <div>{{$article->body}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="height: 4rem"></div>
    @include('admin.desktop._footer')
@endsection