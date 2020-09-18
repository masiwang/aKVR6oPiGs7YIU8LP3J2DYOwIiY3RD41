@extends('_master')

@section('title')
    Dashboard
@endsection

@section('content')
    @include('admin.components._navbar')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="card shadow mb-3 bg-white rounded" style="height:25rem">
                    <div class="card-header">
                       <h5 class="mb-0 text-blue">Sebaran Industri</h5> 
                    </div>
                    <div id="map" style="height:100%" class="card-body p-0"></div>
                </div>
            </div>
            <div class="col-4">
                <div class="card shadow mb-3 bg-white rounded" style="height:25rem">
                    <div class="card-header">
                       <h5 class="mb-0 text-blue">Aktivitas Terakhir</h5> 
                    </div>
                    <div class="card-body p-0" style="overflow-y:scroll">
                        <ul class="list-group list-group-flush">
                            @foreach ($logs as $log)
                            <li class="list-group-item" style="font-size:0.8em"><b>{{$log->created_at}}</b><br/>Admin {{$log->user_id}} {{$log->action}} {{$log->object}} "{{$log->name}}"</li>
                            @endforeach
                            <li class="list-group-item text-center" style="font-size:0.8em"><a class="btn btn-primary btn-sm w-50" href="{{url('admin/logs')}}">Lihat semua</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div style="height: 1rem"></div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow bg-white rounded">
                    <div class="card-header d-flex justify-content-between">
                       <h5 class="mb-0 text-blue">5 Industri terakhir ditambahkan</h5>
                       <a href="{{url('admin/perusahaan')}}" class="btn btn-sm btn-primary">Lihat Semua</a>
                    </div>
                    <div class="card-body" style="font-size: .8rem">
                        <table class="table table-hover table-sm table-industri">
                            <thead class="text-primary">
                                <th width="15%">Nama Perusahaan</th>
                                <th width="10%">Pemilik</th>
                                <th width="8%">Telepon</th>
                                <th>Alamat</th>
                                <th>Tipe</th>
                                <th>Produk</th>
                                <th width="5%">Karyawan</th>
                                <th width="5%"></th>
                            </thead>
                            <tbody>
                                @foreach ($industri as $i)
                                <tr>
                                    <td>{{$i->nama_perusahaan}}</td>
                                    <td>{{$i->nama_pemilik}}</td>
                                    <td>{{$i->telepon}}</td>
                                    <td>{{$i->jalan}}, {{$i->kelurahan}}, {{$i->kecamatan}}</td>
                                    <td>{{$i->tipe_industri}}</td>
                                    <td>{{$i->produk}}</td>
                                    <td data-toggle="tooltip" data-html="true" title="Laki-laki: {{$i->karyawan_laki}} / Perempuan: {{$i->karyawan_perempuan}}">{{(int)($i->karyawan_laki)+(int)($i->karyawan_perempuan)}}</td>
                                    <td>
                                        <a class="btn btn-sm btn-info" href="{{url('/admin/perusahaan/'.$i->id.'/view')}}">
                                            <i>
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z"/>
                                                    <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                                </svg>
                                            </i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="height: 4rem"></div>
    @include('admin.desktop._footer')
    @foreach ($map_data as $i)
    <input type="hidden" class="map-locator" data-id="{{$i->id}}" data-name="{{$i->nama_perusahaan}}" data-alamat="{{$i->jalan}}, {{$i->kelurahan}}, {{$i->kecamatan}}" data-tipe="{{$i->tipe_id}}" data-tipeName="{{$i->tipe_industri}}" data-x="{{$i->latitude}}" data-y="{{$i->longitude}}">
    @endforeach
    <script type="text/javascript" src="{{asset('vendor/leaflet/js/geoJson.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendor/leaflet/js/icon.js')}}"></script>
    <script type="module">import Utm from 'https://cdn.jsdelivr.net/npm/geodesy@2/utm.js'; var mymap=L.map('map').setView([-7.5636207951, 110.8213181164], 12); L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWF1bGFuYWlhIiwiYSI6ImNrYnVidmdhdDAxbWgyc3Fjem8yeWx1cG4ifQ.45a-UzImpVNBUWd-TRt5qQ',{attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>', maxZoom: 18, id: 'mapbox/streets-v11', tileSize: 512, zoomOffset: -1, accessToken: 'your.mapbox.access.token'}).addTo(mymap); var industri=document.querySelectorAll("input.map-locator"); industri.forEach(function(item, index, array){var id=item.getAttribute('data-id'); var x=item.getAttribute('data-x'); var y=item.getAttribute('data-y'); var name=item.getAttribute('data-name'); var alamat=item.getAttribute('data-alamat'); var tipe=item.getAttribute('data-tipe'); var tipeStr=item.getAttribute('data-tipeName'); console.log(x,y); var query='49 S '+x+' '+y; const utmCoord=Utm.parse(query); const latLongP=utmCoord.toLatLon(); var result=latLongP.toString('d', 10).split(", "); var x="-"+result[0].slice(1, 13); var y=result[1].slice(0, 14); if(tipe==1){var icon=redIcon;}if(tipe==3){var icon=yellowIcon;}if(tipe==2){var icon=greenIcon;}var marker=L.marker([x, y],{icon: icon}).addTo(mymap); marker.bindPopup("<b>"+name+"</b><br/>"+alamat+"<br/>"+tipeStr+'<br/><a class="text-decoration-none" href="/admin/perusahaan/'+id+'/view">Detail</a>');}); L.geoJSON(MyGeo,{style: function(feature, layer){switch (feature.properties.kecamatan){case 'Banjarsari': return{color: '#d50000'}; case 'Jebres': return{color: "#ffab00"}; case 'Serengan': return{color: "#0026ca"}; case 'Pasar Kliwon': return{color: "#00c853"}; case 'Laweyan': return{color: "#aa00ff"};}}, onEachFeature: function (feature, layer){layer.bindPopup("<b>Kec. "+feature.properties.kecamatan + "</b><br/><hr style='margin:3px 0 5px 0'/><a class='text-decoration-none' href='/admin/perusahaan?kecamatan="+feature.properties.kecamatan+"'>Lihat daftar industri</a>"); layer.on('mouseover', function (e){this.setStyle({'fillOpacity': '1'});}); layer.on('mouseout', function (){this.setStyle({'fillOpacity': '0.5'});}); layer.on('click', function (){this.openPopup();});}}).addTo(mymap);</script>
@endsection