@extends('_master')

@section('title')
    Daftar Perusahaan
@endsection

@section('content')
    @include('admin.components._navbar')
    <div class="container">
        <div class="row pt-2">
            <div class="col-12">
                @if (\Session::has('success'))
                <div class="card shadow bg-white rounded">
                    <div class="alert alert-success mb-0" role="alert">
                        {{\Session::get('success')}}
                    </div>
                </div>
                <div style="height: 1rem"></div>
                @endif
                <div class="card shadow bg-white rounded">
                    <div class="card-body pb-0">
                        <form class="row g-2">
                            <div class="col-2">
                                <input type="text" class="form-control form-control-sm" name="industri" value="{{Request::get('industri')}}" placeholder="Nama Perusahaan">
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control form-control-sm" name="kelurahan" value="{{Request::get('kelurahan')}}" placeholder="Kelurahan">
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control form-control-sm" name="kecamatan" value="{{Request::get('kecamatan')}}" placeholder="Kecamatan">
                            </div>
                            <div class="col-2">
                                <select class="form-select form-select-sm" name="tipe" aria-label=".form-select-sm example">
                                    <option value="">Semua</option>
                                    <option value="1" @if(Request::get('tipe')==1) selected @endif>Agro dan Aneka Pangan</option>
                                    <option value="2" @if(Request::get('tipe')==2) selected @endif>Aneka Usaha Industri</option>
                                    <option value="3" @if(Request::get('tipe')==3) selected @endif>Tekstil dan Produk Tekstil</option>
                                  </select>
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control form-control-sm" name="produk" value="{{Request::get('produk')}}" placeholder="Produk">
                            </div>
                            <div class="col-1">
                                <button type="submit" class="btn btn-primary btn-sm mb-3 w-100">Cari</button>
                            </div>
                            <div class="col-1">
                                <a id="getURI"" class="btn btn-success btn-sm mb-3 w-100">Eksport</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div style="height: 1rem"></div>
                <div class="card shadow bg-white rounded" style="height:auto">
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-hover table-sm" style="font-size: .7rem">
                            <thead class="text-primary">
                                <th width="15%" class="text-center">Nama Industri</th>
                                <th width="10%" class="text-center">Pemilik</th>
                                <th width="8%" class="text-center">Telepon</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Tipe</th>
                                <th class="text-center">Komoditas</th>
                                <th width="5%" class="text-center">Karyawan</th>
                                <th  class="text-center" width="{{(Session::get('role') == 'operator') ? '11%' : '5%'}}">Aksi</th>
                            </thead>
                            <tbody>
                                @foreach ($perusahaan as $p)
                                <tr id="perusahaan-{{$p->id}}">
                                    <td>{{$p->nama_perusahaan}}</td>
                                    <td>{{$p->nama_pemilik}}</td>
                                    <td>{{$p->telepon}}</td>
                                    <td>{{$p->jalan}}, {{$p->kelurahan}}, {{$p->kecamatan}}</td>
                                    <td>{{$p->tipe_industri}}</td>
                                    <td>{{$p->komoditas}}</td>
                                    <td>L: {{$p->karyawan_laki}}<br/>P: {{$p->karyawan_perempuan}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-info" href="{{url('/admin/perusahaan/'.$p->id.'/view')}}">
                                            <i>
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z"/>
                                                    <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                                </svg>
                                            </i>
                                        </a>
                                        @if (Session::get('role') == 'operator')
                                        <a class="btn btn-sm btn-warning" href="{{url('/admin/perusahaan/'.$p->id.'/edit')}}">
                                            <i>
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z"/>
                                                    <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 0 0 .5.5H4v.5a.5.5 0 0 0 .5.5H5v.5a.5.5 0 0 0 .5.5H6v-1.5a.5.5 0 0 0-.5-.5H5v-.5a.5.5 0 0 0-.5-.5H3z"/>
                                                </svg>
                                            </i>
                                        </a>
                                        <a class="btn btn-sm btn-danger action-delete" href="{{url('admin/perusahaan/'.$p->id.'/delete')}}">
                                            <i>
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                </svg>
                                            </i>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div style="height: 1rem"></div>
                <div class=" d-flex justify-content-center mb-5">
                    {{$perusahaan->appends(request()->input())->links()}}
                </div>
            </div>
        </div>
    </div>
    <script>
        const btnGetURI = document.querySelector('#getURI');
        btnGetURI.addEventListener('click', function(){
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            // industri=Maul&kelurahan=&kecamatan=&tipe=&produk=
            console.log("{{url('admin/get')}}"+queryString);
            // xhttp.open("GET", "demo_get2.asp?"+queryString, true);
            // xhttp.send();
            // console.log(urlParams.get('industri'));
        });
    </script>
@endsection