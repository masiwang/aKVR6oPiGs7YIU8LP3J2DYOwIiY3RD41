<section class="mt-2 mt-md-3 px-1">
    <div class="row">
        <div class="col-12">
            <div id="mapid" class="shadow-sm"></div>
        </div>
    </div>
    @foreach ($map_data as $i)
    <input type="hidden" class="map-locator" data-id="{{$i->id}}" data-name="{{$i->nama_perusahaan}}"
        data-tipe="{{$i->tipe_id}}" data-tipeName="{{$i->tipe_industri}}" data-alamat="{{$i->jalan}}, {{$i->kelurahan}}, {{$i->kecamatan}}" data-x="{{$i->latitude}}"
        data-y="{{$i->longitude}}">
    @endforeach
</section>
<section id="mapLegend" class="container d-flex justify-content-center">
    <div class="row">
        <div class="col-12">
            <div class="row bg-white p-3 shadow-sm">
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
<script type="text/javascript" src="{{asset('vendor/leaflet/js/geoJson.js')}}"></script>
<script type="text/javascript" src="{{asset('vendor/leaflet/js/icon.js')}}"></script>
<script type="module">import Utm from"https://cdn.jsdelivr.net/npm/geodesy@2/utm.js";var mymap=L.map("mapid").setView([-7.56,110.8213181164],13);L.tileLayer("https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWF1bGFuYWlhIiwiYSI6ImNrYnVidmdhdDAxbWgyc3Fjem8yeWx1cG4ifQ.45a-UzImpVNBUWd-TRt5qQ",{attribution:'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',maxZoom:18,id:"mapbox/streets-v11",tileSize:512,zoomOffset:-1,accessToken:"your.mapbox.access.token"}).addTo(mymap);var industri=document.querySelectorAll("input.map-locator");industri.forEach(function(t,e,a){t.getAttribute("data-id");var o=t.getAttribute("data-x"),r=t.getAttribute("data-y"),i=t.getAttribute("data-name"),n=t.getAttribute("data-alamat"),s=t.getAttribute("data-tipe"),c=t.getAttribute("data-tipeName"),p="49 S "+o+" "+r;var m=Utm.parse(p).toLatLon().toString("d",10).split(", "),d="-"+m[0].slice(1,13),u=m[1].slice(0,14);if(1==s)var l=redIcon;if(3==s)l=yellowIcon;if(2==s)l=greenIcon;L.marker([d,u],{icon:l}).addTo(mymap).bindPopup("<b>"+i+"</b><br/>"+n+"<br/><i>"+c+"</i><br/><a href='https://www.google.com/maps/dir/?api=1&destination="+d+","+u+"' class='text-decoration-none'>Buka di GoogleMaps</a>")}),L.geoJSON(MyGeo,{style:function(t,e){switch(t.properties.kecamatan){case"Banjarsari":return{color:"#d50000"};case"Jebres":return{color:"#ffab00"};case"Serengan":return{color:"#0026ca"};case"Pasar Kliwon":return{color:"#00c853"};case"Laweyan":return{color:"#aa00ff"}}},onEachFeature:function(t,e){e.bindPopup("<b>Kec. "+t.properties.kecamatan+"</b><br/><hr style='margin:3px 0 5px 0'/><a class='text-decoration-none' href='/perusahaan?kecamatan="+t.properties.kecamatan+"'>Lihat daftar industri</a>"),e.on("mouseover",function(t){this.setStyle({fillOpacity:"1"})}),e.on("mouseout",function(){this.setStyle({fillOpacity:"0.5"})}),e.on("click",function(){this.openPopup()})}}).addTo(mymap);</script>