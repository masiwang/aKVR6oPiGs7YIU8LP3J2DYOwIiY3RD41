<nav class="navbar navbar-expand-lg navbar-dark bg-transparent-rodo shadow mb-5 py-0">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{url('/')}}"><span style="font-size:1.1em;font-weight:800">SIIKa</span><br/><div style="font-size:0.6em;transform:translateY(-6px)">Surakarta</div></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto">
                @if ($user ?? '')
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{url('/admin')}}">Dashboard</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-expanded="false">
                        Artikel
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="{{url('admin/article')}}">Daftar Artikel</a></li>
                        @if ($user ?? ''->role == 'operator')
                            <li><a class="dropdown-item" href="{{url('admin/article/new')}}">Tambah Baru</a></li>    
                        @endif
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-expanded="false">
                        Perusahaan
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="{{url('admin/perusahaan')}}">Daftar</a></li>
                        @if ($user ?? ''->role == 'operator')
                            <li><a class="dropdown-item" href="{{url('admin/perusahaan/new')}}">Baru</a></li>
                            <li><a class="dropdown-item" href="{{url('admin/perusahaan/import')}}">Import</a></li>
                            <li><a class="dropdown-item" href="{{url('admin/perusahaan/export')}}">Eksport</a></li>
                        @endif
                    </ul>
                </li>
                @endif
            </ul>
            <ul class="navbar-nav">
                @if ($user ?? '')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdownMenuLink" role="button" data-toggle="dropdown" aria-expanded="false">
                        Admin
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdownMenuLink">
                        <li><a class="dropdown-item" href="{{url('admin/profile')}}">Profil</a></li>
                        <li><a class="dropdown-item" href="{{url('admin/logs')}}">Log Aktivitas</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{url('admin/list')}}">Daftar Admin</a></li>
                        @if ($user->role == 'pimpinan')
                        <li><a class="dropdown-item" href="{{url('admin/new')}}">Tambah Admin</a></li>
                        @endif
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{url('logout')}}">Keluar</a></li>
                    </ul>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{url('/login')}}">Login</a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>