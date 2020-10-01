<nav id="fixedBar" class="navbar navbar-expand-lg navbar-light fixed-top shadow mb-5 bg-white py-0">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{url('/')}}"><span style="font-size:1.1em;font-weight:800">SIIKa</span><br/><div style="font-size:0.6em;transform:translateY(-6px)">Surakarta</div></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto">
                
            </ul>
            <ul class="navbar-nav" id="toplinks">
                <li class="nav-item">
                    <a class="nav-link scroll" data-offset="80" href="#top">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link scroll" data-offset="80" href="#artikel">Artikel Berita</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link scroll" data-offset="80" href="#dasar-hukum">Dasar Hukum</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link scroll" data-offset="80" href="#statistik">Statistik</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link scroll" data-offset="80" href="#charts">Grafik</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link scroll" data-offset="80" href="#tabel-perusahaan">Tabel Perusahaan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link scroll" data-offset="80" href="#map">Peta Sebaran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link scroll" data-offset="80" href="#contact">Kontak</a>
                </li>
                <li class="nav-item">
                    @if (!$user)
                    <a class="nav-link scroll" data-offset="80" href="{{url('/login')}}">Login</a>
                    @else
                    <a class="nav-link scroll" data-offset="80" href="{{url('/admin')}}">Admin</a>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>




