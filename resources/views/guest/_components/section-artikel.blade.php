<section id="artikel" class="container d-flex justify-content-center mt-2 mt-md-3">
    <div class="row">
        <div class="col-sm-12 shadow-sm bg-white p-3">
            <div class="row article-title">
                <div class="col-12">
                    <h6 class="mb-0 card-title font-weight-bold text-center text-uppercase">Artikel</h6>
                </div>
            </div>
            <hr/>
            <div class="row">
                @foreach ($artikel as $a)
                <div class="col-6 col-md-3">
                    <img class="image-artikel" src="{{asset($a->image_url)}}" width="100%" height="160px"/>
                    <p class="text-success mb-0"><b>{{ $a->title }}</b></p>
                    <a href="{{url('artikel/'.$a->id.'/view')}}" class="text-decoration-none text-secondary"><small>Baca artikel...</small></a>
                </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-2 mt-md-3">
                <a href="{{ url('artikel') }}" class="btn-success btn-sm text-decoration-none">Lebih banyak artikel</a>
            </div>
        </div>
    </div>
</section>