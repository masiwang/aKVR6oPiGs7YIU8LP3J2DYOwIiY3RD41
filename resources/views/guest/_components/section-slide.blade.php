{{-- Dokumentasi bootstrap v5 https://v5.getbootstrap.com/docs/5.0/components/carousel/ --}}
<div id="siikaSlider" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner shadow-sm bg-white">
        @php $n=0; @endphp {{-- inisiasi index slider --}}
        @foreach ($slide as $s) {{-- mengambil data setiap slide dari controller --}}
            @php
                $n++; //index slider increment
                $isActive = ($n==1)?' active':''; //inisiasi variabel isActive untuk slider, aktif hanya jika n = 1
            @endphp
            <div class="carousel-item {{$isActive}}">
                <img src="{{asset($s->image_url)}}">
                <div class="carousel-caption">
                    <h5>{{$s->title}}</h5> {{-- mengambil data judul artikel dari controller --}}
                    <p>{!!substr($s->body, 0, 100)!!}</p> {{-- mengambil data isi artikel dari controller, merender isi artikel menjadi komponen html, memotong hanya 100 karakter yang ditampilkan --}}
                </div>
            </div>
        @endforeach
    </div>

    <a class="carousel-control-prev" href="#siikaSlider" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    
    <a class="carousel-control-next" href="#siikaSlider" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
