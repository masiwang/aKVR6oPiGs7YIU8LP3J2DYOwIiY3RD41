<nav id="fixedBar" class="navbar navbar-expand-lg navbar-dark fixed-top shadow-sm mb-5 py-0" style="background-color: #3a526a">
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
                    <a class="nav-link scroll" data-offset="80" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link scroll" data-offset="80" href="#artikel" data-target="#artikel">Artikel Berita</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link scroll" data-offset="80" href="#dasarHukum" data-target="#dasarHukum">Dasar Hukum</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link scroll" data-offset="80" href="#statistik" data-target="#statistik">Statistik</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link scroll" data-offset="80" href="#grafik" data-target="#grafik">Grafik</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link scroll" data-offset="80" href="#tabel" data-target="#tabel">Tabel Perusahaan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link scroll" data-offset="80" href="#map" data-target="#map">Peta Sebaran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link scroll" data-offset="80" href="#kontak" data-target="#kontak">Kontak</a>
                </li>
                <li class="nav-item">
                    @if (!$user) {{-- Jika tidak ada user yang terautentikasi --}}
                        {{-- Tampilkan link login --}}
                        <a class="nav-link scroll" data-offset="80" href="{{url('/login')}}">Login</a>
                    @else {{-- Jika ada --}}
                        {{-- Tampilkan link admin --}}
                        <a class="nav-link scroll" data-offset="80" href="{{url('/admin')}}">Admin</a>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>