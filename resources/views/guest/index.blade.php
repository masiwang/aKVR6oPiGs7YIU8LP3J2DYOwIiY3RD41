@extends('guest/_components/master')

@section('title')
    Halaman Depan
@endsection

@section('content')
    @include('guest/_components/top_nav')
    <div class="container content-container d-flex flex-column" id="top">
        {{-- Mengambil elemen dari file section-slide.blade.php pada folder guest/_components --}}
        @include('guest/_components/section-slide')
        {{-- Mengambil elemen dari file section-dasarhukum.blade.php pada folder guest/_components --}}
        @include('guest/_components/section-dasarhukum')
        {{-- Mengambil elemen dari file section-statistik.blade.php pada folder guest/_components --}}
        @include('guest/_components/section-statistik')
        {{-- Mengambil elemen dari file section-grafik.blade.php pada folder guest/_components --}}
        @include('guest/_components/section-grafik')
        {{-- Mengambil elemen dari file section-tabel.blade.php pada folder guest/_components --}}
        @include('guest/_components/section-tabel')
        {{-- Mengambil elemen dari file section-map.blade.php pada folder guest/_components --}}
        @include('guest/_components/section-map')
        {{-- Mengambil elemen dari file section-artikel.blade.php pada folder guest/_components --}}
        @include('guest/_components/section-artikel')
    </div>
    {{-- Mengambil elemen dari file footer.blade.php pada folder guest/_components --}}
    @include('guest/_components/footer')
@endsection