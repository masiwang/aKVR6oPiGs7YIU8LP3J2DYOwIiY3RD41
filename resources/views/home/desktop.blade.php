@extends('_master')
@section('title') Halaman Depan @endsection
@section('content')
<script type="text/javascript">
    if (screen.width <= 736){document.location = "/mobile";}
</script>
@include('home/_navbar')
<div class="container mt-5 p-0" id="top">
    <div style="height: 3rem"></div>
    <div id="siikaSlider" class="carousel slide" style="max-height:400px" data-ride="carousel">
        <div class="carousel-inner shadow bg-white" style="max-height:400px; min-height:400px">
            @php $n=0; @endphp
            @foreach ($slide as $s)
            @php 
                $n++; 
                $isActive = ($n==1)?' active':'';
            @endphp
            <div class="carousel-item {{$isActive}}">
                <img src="{{asset($s->image_url)}}" class="d-block w-100" style="object-fit: cover;width:100%; max-height:400px" alt="...">
                <div class="carousel-caption d-none d-md-block d-sm-none" style="transform:translate(-15%, 0);position:absolute; bottom:-1px; right:0; width:100%; background-color:rgba(68, 68, 68, 0.73);">
                    <h5>{{$s->title}}</h5>
                    <p>{!!substr($s->body, 0, 100)!!}</p>
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
    
    <div id="dasar-hukum" style="height: 4rem"></div>
    <section class="container d-flex justify-content-center">
        <div class="row">
            <div class="col-12 shadow bg-white rounded">
                <div class="row pt-2">
                    <div class="col-12 text-center">
                        <h5 class="font-weight text-blue">Dasar Hukum</h5>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-sm-4 bg-white" style="border-radius: 30px 0 0 30px">
                        <p class="text-center text-secondary font-italic my-2">UU No. 14 Tahun 2018</p>
                    </div>
                    <div class="col-sm-4 bg-white">
                        <p class="text-center text-secondary font-italic my-2">UU No. 14 Tahun 2018</p>
                    </div>
                    <div class="col-sm-4 bg-white" style="; border-radius: 0px 30px 30px 0px">
                        <p class="text-center text-secondary font-italic my-2">UU No. 14 Tahun 2018</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="statistik" style="height: 4rem"></div>
    <section class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row justify-content-center">
                    <div class="col-4 pl-0">
                        <div class="card shadow bg-white rounded">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-2 text-muted text-center text-uppercase ">Industri</h6>
                                <h6 class="card-title font-weight-bold text-center">Tekstik dan Produk Tekstil</h6>
                                <hr>
                                <h1 class="card-text mb-0 text-center text-primary" style="font-size: 4rem">{{$stats['industri'][0]}}</h1>
                                <p class="text-center font-italic" style="">unit usaha</p>
                                <h1 class="card-text mb-0 text-center text-primary" style="font-size: 4rem">{{$stats['karyawan'][0]}}</h1>
                                <p class="text-center font-italic"style="">pakerja</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card shadow bg-white rounded">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-2 text-muted text-center text-uppercase ">Industri</h6>
                                <h6 class="card-title font-weight-bold text-center">Aneka Usaha Industri</h6>
                                <hr>
                                <h1 class="card-text mb-0 text-center text-primary" style="font-size: 4rem">{{$stats['industri'][1]}}</h1>
                                <p class="text-center font-italic" style="">unit usaha</p>
                                <h1 class="card-text mb-0 text-center text-primary" style="font-size: 4rem">{{$stats['karyawan'][1]}}</h1>
                                <p class="text-center font-italic" style="">pakerja</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 pr-0">
                        <div class="card shadow bg-white rounded">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-2 text-muted text-center text-uppercase ">Industri</h6>
                                <h6 class="card-title font-weight-bold text-center">Agro dan Aneka Pangan</h6>
                                <hr>
                                <h1 class="card-text mb-0 mb-0 text-center text-primary" style="font-size: 4rem">{{$stats['industri'][2]}}</h1>
                                <p class="text-center font-italic"style="">unit usaha</p>
                                <h1 class="card-text mb-0 text-center text-primary" style="font-size: 4rem">{{$stats['karyawan'][2]}}</h1>
                                <p class="text-center font-italic"style="">pakerja</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="charts" style="height: 4rem"></div>
    <section class="container d-flex justify-content-center">
        <div class="row">
            <div class="col-12 shadow bg-white rounded p-3">
                <h6 class="card-subtitle mb-2 text-uppercase text-muted text-center">Grafik sebaran</h6>
                <h6 class="card-title font-weight-bold text-center">Semua Industri</h6>
                <div class="canvas-container">
                    <canvas id="chartDesktopFront"></canvas>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="#" id="btnChartDetail" class="btn btn-primary w-100" data-toggle="modal" data-target="#chartDesktop">Lihat semua grafik</a>
                </div>
            </div>
        </div>
    </section>
    <div id="chartDesktop" class="modal rounded" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" width="100%">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#industri1" role="tab" aria-controls="industri_1" aria-selected="true">Industri Tekstik dan Produk Tekstil</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#industri2" role="tab" aria-controls="industri_2" aria-selected="false">Industri Aneka Usaha Industri</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#industri3" role="tab" aria-controls="industri_3" aria-selected="false">Industri Agro dan Aneka Pangan</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#industri4" role="tab" aria-controls="industri_4" aria-selected="false">Semua Industri</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="industri1" role="tabpanel" aria-labelledby="industri_1-tab">
                            <canvas id="chartDesktop1"></canvas>
                        </div>
                        <div class="tab-pane fade" id="industri2" role="tabpanel" aria-labelledby="industri_2-tab">
                            <canvas id="chartDesktop2"></canvas>
                        </div>
                        <div class="tab-pane fade" id="industri3" role="tabpanel" aria-labelledby="industri_3-tab">
                            <canvas id="chartDesktop3"></canvas>
                        </div>
                        <div class="tab-pane fade" id="industri4" role="tabpanel" aria-labelledby="industri_4-tab">
                            <canvas id="chartDesktop4"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="tabel-perusahaan"  style="height: 4em"></div>
    <section class="container d-flex justify-content-center">
        <div class="row">
            <div class="col-sm-12 shadow bg-white rounded p-3">
                <div class="row pt-2">
                    <div class="col-12 text-center">
                        <h6 class="font-weight text-muted text-uppercase">Tabel</h6>
                        <h6 class="font-weight text-dark">Daftar Perusahaan</h6>
                    </div>
                </div>
                <hr/>
                <table class="table table-hover table-sm" style="font-size:0.8em">
                    <thead class="text-primary">
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
                    <a href="/perusahaan" class="btn btn-primary w-100">Lihat semua perusahaan</a>
                </div>
            </div>
        </div>
    </section>
    <div id="map" style="height: 4rem"></div>
    <section>
        <div class="row">
            <div class="col-12">
                <div id="mapid" class="shadow rounded" style="max-width: 100%; height: 30rem"></div>
            </div>
        </div>
        @foreach ($map_data as $i)
        <input type="hidden" class="map-locator" data-id="{{$i->id}}" data-name="{{$i->nama_perusahaan}}"
            data-tipe="{{$i->tipe_id}}" data-tipeName="{{$i->tipe_industri}}" data-alamat="{{$i->jalan}}, {{$i->kelurahan}}, {{$i->kecamatan}}" data-x="{{$i->latitude}}"
            data-y="{{$i->longitude}}">
        @endforeach
    </section>
    <div style="height: .5rem"></div>
    <section id="mapLegend" class="container d-flex justify-content-center">
        <div class="row">
            <div class="col-12">
                <div class="row bg-white p-3 rounded shadow">
                    <div class="col-4 d-flex justify-content-center">
                        <img src="{{asset('image/maps/red.png')}}" alt="Legenda Peta Merah" srcset="" style="height:24px;margin-right:5px;"> <p class="mb-0"><small> : Industri Agro dan Aneka Pangan</small></p>
                    </div>
                    <div class="col-4 d-flex justify-content-center">
                        <img src="{{asset('image/maps/yellow.png')}}" alt="Legenda Peta Kuning" srcset="" style="height:24px;margin-right:5px;"> <p class="mb-0"><small> : Industri Tekstil dan Produk Tekstil</small></p>
                    </div>
                    <div class="col-4 d-flex justify-content-center">
                        <img src="{{asset('image/maps/green.png')}}" alt="Legenda Peta Hijau" srcset="" style="height:24px;margin-right:5px;"> <p class="mb-0"><small> : Industri Aneka Usaha</small></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="artikel" style="height: 4rem"></div>
    <section class="container d-flex justify-content-center">
        <div class="row">
            <div class="col-sm-12 shadow bg-white rounded p-3">
                <div class="row article-title">
                    <div class="col-12">
                        <h6 class="mb-0 card-title font-weight-bold text-center text-uppercase">Artikel</h6>
                    </div>
                </div>
                <hr/>
                @foreach ($artikel as $a)
                <div class="row pb-1">
                    <div class="col-2 d-flex justify-content-center" style="max-width:100px">
                        <img src="{{asset($a->image_url)}}" width="70px" height="60px"/>
                    </div>
                    <div class="col-10">
                        <b><a href="{{url('artikel/'.$a->id.'/view')}}" class="text-decoration-none">{{$a->title}}</a></b><br />
                        <p>{!!$a->body!!}</p>
                    </div>
                </div>
                @endforeach
                <div class="d-flex justify-content-center">
                    {{$artikel->links()}}
                </div>
            </div>
        </div>
    </section>
</div>
<div style="height: 4rem"></div>
<div class="container-fluid p-0">
    <section  id="contact" class="text-light p-3 pb-5" style="background-color:#071a52">
        <div style="height:2rem"></div>
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <h4>Informasi Kontak</h4>
                    <hr>
                    <ul class="nav flex-column">
                        <li class="nav-item footer-link">
                            <a>
                                <span>
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-geo-alt" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                    </svg>
                                </span> JL. Jenderal Sudirman, No. 2, Kp. Baru, Kec. Ps. Kliwon, Kota Surakarta 57133 </a>
                        </li>
                        <li class="nav-item footer-link">
                            <a>
                                <span>
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-telephone-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M2.267.98a1.636 1.636 0 0 1 2.448.152l1.681 2.162c.309.396.418.913.296 1.4l-.513 2.053a.636.636 0 0 0 .167.604L8.65 9.654a.636.636 0 0 0 .604.167l2.052-.513a1.636 1.636 0 0 1 1.401.296l2.162 1.681c.777.604.849 1.753.153 2.448l-.97.97c-.693.693-1.73.998-2.697.658a17.47 17.47 0 0 1-6.571-4.144A17.47 17.47 0 0 1 .639 4.646c-.34-.967-.035-2.004.658-2.698l.97-.969z"/>
                                    </svg>
                                </span> 0271 - 638738 </a>
                        </li>
                        <li class="nav-item footer-link">
                            <a>
                                <span>
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-envelope-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
                                    </svg>
                                </span> dinasperdagangan@surakarta.go.id</a>
                        </li>
                    </ul>
                </div>
                <div class="col-3">
                    <h4>Link Terkait</h4>
                    <hr>
                    <ul class="nav flex-column">
                        <li class="nav-item footer-link">
                            <a href="https://ipc.disnakerperin.surakarta.go.id/">Industry Promotion Center</a>
                        </li>
                        <li class="nav-item footer-link">
                            <a href="https://surakarta.go.id/">Pemerintah Kota Surakarta</a>
                        </li>
                        <li class="nav-item footer-link">
                            <a href="https://dinasperdagangan.surakarta.go.id/">Dinas Perdagangan Kota Surakarta</a>
                        </li>
                        <li class="nav-item footer-link">
                            <a href="http://jdih.surakarta.go.id/">JDIH Kota Surakarta</a>
                        </li>
                        <li class="nav-item footer-link">
                            <a href="https://www.kemendag.go.id/id">Kementrian Perdagangan RI</a>
                        </li>
                        <li class="nav-item footer-link">
                            <a href="http://www.depkop.go.id/">Kementrian Koperasi dan UMKM RI</a>
                        </li>
                    </ul>
                </div>
                <div class="col-3">
                    <h4>Ikuti Kami</h4>
                    <hr>
                    <ul class="nav flex-column">
                        <li class="nav-item footer-link">
                            <a href="#">Facebook</a>
                        </li>
                        <li class="nav-item footer-link">
                            <a href="#">Twitter</a>
                        </li>
                        <li class="nav-item footer-link">
                            <a href="#">Google Plus</a>
                        </li>
                        <li class="nav-item footer-link">
                            <a href="#">Instagram</a>
                        </li>
                        <li class="nav-item footer-link">
                            <a href="#">Youtube</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
    </section>
    <section style="background-color: #000931">
        <div class="text-light text-center p-3">
            Copyright &copy{{date('Y')}} - Dinas Perdagangan Kota Surakarta
        </div>
    </section>
</div>
<script type="text/javascript" src="{{asset('vendor/leaflet/js/geoJson.js')}}"></script>
<script type="text/javascript" src="{{asset('vendor/leaflet/js/icon.js')}}"></script>
<script>var ctx1=document.getElementById("chartDesktop1"),myChart=new Chart(ctx1,{type:"bar",data:{labels:[@foreach($kecamatan as $k) "{{$k->name}}", @endforeach],datasets:[{label:"Jml industri",data:[@foreach($graph['tipe1'] as $g) "{{$g}}", @endforeach],backgroundColor:["rgba(255, 99, 132, 0.2)","rgba(54, 162, 235, 0.2)","rgba(255, 206, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(153, 102, 255, 0.2)"],borderColor:["rgba(255, 99, 132, 1)","rgba(54, 162, 235, 1)","rgba(255, 206, 86, 1)","rgba(75, 192, 192, 1)","rgba(153, 102, 255, 1)"],borderWidth:1}]},options:{scales:{yAxes:[{ticks:{beginAtZero:!0},scaleLabel:{display:!0,labelString:"unit usaha"}}]}}});var ctx2=document.getElementById("chartDesktop2"),myChart=new Chart(ctx2,{type:"bar",data:{labels:[@foreach($kecamatan as $k) "{{$k->name}}", @endforeach],datasets:[{label:"Jml industri",data:[@foreach($graph['tipe2'] as $g) "{{$g}}", @endforeach],backgroundColor:["rgba(255, 99, 132, 0.2)","rgba(54, 162, 235, 0.2)","rgba(255, 206, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(153, 102, 255, 0.2)"],borderColor:["rgba(255, 99, 132, 1)","rgba(54, 162, 235, 1)","rgba(255, 206, 86, 1)","rgba(75, 192, 192, 1)","rgba(153, 102, 255, 1)"],borderWidth:1}]},options:{scales:{yAxes:[{ticks:{beginAtZero:!0},scaleLabel:{display:!0,labelString:"unit usaha"}}]}}});var ctx3=document.getElementById("chartDesktop3"),myChart=new Chart(ctx3,{type:"bar",data:{labels:[@foreach($kecamatan as $k) "{{$k->name}}", @endforeach],datasets:[{label:"Jml industri",data:[@foreach($graph['tipe3'] as $g) "{{$g}}", @endforeach],backgroundColor:["rgba(255, 99, 132, 0.2)","rgba(54, 162, 235, 0.2)","rgba(255, 206, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(153, 102, 255, 0.2)"],borderColor:["rgba(255, 99, 132, 1)","rgba(54, 162, 235, 1)","rgba(255, 206, 86, 1)","rgba(75, 192, 192, 1)","rgba(153, 102, 255, 1)"],borderWidth:1}]},options:{scales:{yAxes:[{ticks:{beginAtZero:!0},scaleLabel:{display:!0,labelString:"unit usaha"}}]}}});var ctx4=document.getElementById("chartDesktop4"),myChart=new Chart(ctx4,{type:"bar",data:{labels:[@foreach($kecamatan as $k) "{{$k->name}}", @endforeach],datasets:[{label:"Jml industri",data:[@foreach($graph['semua'] as $g) "{{$g}}", @endforeach],backgroundColor:["rgba(255, 99, 132, 0.2)","rgba(54, 162, 235, 0.2)","rgba(255, 206, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(153, 102, 255, 0.2)"],borderColor:["rgba(255, 99, 132, 1)","rgba(54, 162, 235, 1)","rgba(255, 206, 86, 1)","rgba(75, 192, 192, 1)","rgba(153, 102, 255, 1)"],borderWidth:1}]},options:{scales:{yAxes:[{ticks:{beginAtZero:!0},scaleLabel:{display:!0,labelString:"unit usaha"}}]}}});var ctx5=document.getElementById("chartDesktopFront"),myChart=new Chart(ctx5,{type:"bar",data:{labels:[@foreach($kecamatan as $k) "{{$k->name}}", @endforeach],datasets:[{label:"Jml industri",data:[@foreach($graph['semua'] as $g) "{{$g}}", @endforeach],backgroundColor:["rgba(255, 99, 132, 0.2)","rgba(54, 162, 235, 0.2)","rgba(255, 206, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(153, 102, 255, 0.2)"],borderColor:["rgba(255, 99, 132, 1)","rgba(54, 162, 235, 1)","rgba(255, 206, 86, 1)","rgba(75, 192, 192, 1)","rgba(153, 102, 255, 1)"],borderWidth:1}]},options:{scales:{yAxes:[{ticks:{beginAtZero:!0},scaleLabel:{display:!0,labelString:"unit usaha"}}]}}});</script>
<script type="module">import Utm from"https://cdn.jsdelivr.net/npm/geodesy@2/utm.js";var mymap=L.map("mapid").setView([-7.56,110.8213181164],13);L.tileLayer("https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWF1bGFuYWlhIiwiYSI6ImNrYnVidmdhdDAxbWgyc3Fjem8yeWx1cG4ifQ.45a-UzImpVNBUWd-TRt5qQ",{attribution:'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',maxZoom:18,id:"mapbox/streets-v11",tileSize:512,zoomOffset:-1,accessToken:"your.mapbox.access.token"}).addTo(mymap);var industri=document.querySelectorAll("input.map-locator");industri.forEach(function(t,e,a){t.getAttribute("data-id");var o=t.getAttribute("data-x"),r=t.getAttribute("data-y"),i=t.getAttribute("data-name"),n=t.getAttribute("data-alamat"),s=t.getAttribute("data-tipe"),c=t.getAttribute("data-tipeName"),p="49 S "+o+" "+r;var m=Utm.parse(p).toLatLon().toString("d",10).split(", "),d="-"+m[0].slice(1,13),u=m[1].slice(0,14);if(1==s)var l=redIcon;if(3==s)l=yellowIcon;if(2==s)l=greenIcon;L.marker([d,u],{icon:l}).addTo(mymap).bindPopup("<b>"+i+"</b><br/>"+n+"<br/><i>"+c+"</i><br/><a href='https://www.google.com/maps/dir/?api=1&destination="+d+","+u+"' class='text-decoration-none'>Buka di GoogleMaps</a>")}),L.geoJSON(MyGeo,{style:function(t,e){switch(t.properties.kecamatan){case"Banjarsari":return{color:"#d50000"};case"Jebres":return{color:"#ffab00"};case"Serengan":return{color:"#0026ca"};case"Pasar Kliwon":return{color:"#00c853"};case"Laweyan":return{color:"#aa00ff"}}},onEachFeature:function(t,e){e.bindPopup("<b>Kec. "+t.properties.kecamatan+"</b><br/><hr style='margin:3px 0 5px 0'/><a class='text-decoration-none' href='/perusahaan?kecamatan="+t.properties.kecamatan+"'>Lihat daftar industri</a>"),e.on("mouseover",function(t){this.setStyle({fillOpacity:"1"})}),e.on("mouseout",function(){this.setStyle({fillOpacity:"0.5"})}),e.on("click",function(){this.openPopup()})}}).addTo(mymap);</script>
@endsection