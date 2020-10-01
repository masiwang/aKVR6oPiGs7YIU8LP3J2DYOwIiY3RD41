@extends('guest._components.master')

@section('title')
    Artikel - {{$article->title}}
@endsection

@section('content')
    @include('guest._components.top_nav')
    <div class="container" style="margin-top: 80px">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('guest._components.footer')
@endsection