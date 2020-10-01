<section class="container d-flex justify-content-center mt-2 mt-md-3">
    <div class="row">
        <div class="col-sm-12 shadow-sm bg-white p-3">
            <div class="row pt-2">
                <div class="col-12 text-center">
                    <h6 class="font-weight text-muted text-uppercase">Tabel</h6>
                    <h6 class="font-weight-bold  text-green">Daftar Perusahaan</h6>
                </div>
            </div>
            <hr/>
            <table class="table table-hover table-sm" style="font-size:0.8em">
                <thead class="text-success">
                    <th>Nama Industri</th>
                    <th>Alamat</th>
                    <th>Tipe</th>
                    <th>Komoditas</th>
                </thead>
                <tbody>
                    @foreach ($perusahaan as $p)
                    <tr id="perusahaan-{{$p->id}}">
                        @if ($p->badan_usaha)
                        <td>{{$p->badan_usaha}}. {{$p->nama_perusahaan}}</td>
                        @else
                        <td>{{$p->nama_perusahaan}}</td>
                        @endif
                        <td>{{$p->jalan}}, {{$p->kelurahan}}, {{$p->kecamatan}}</td>
                        <td>{{$p->tipe_industri}}</td>
                        <td>{{$p->komoditas}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                <a href="/perusahaan" class="btn btn-success w-100">Lihat semua perusahaan</a>
            </div>
        </div>
    </div>
</section>