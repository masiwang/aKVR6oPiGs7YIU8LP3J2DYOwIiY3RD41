<section class="px-3 d-flex justify-content-center mt-2 mt-md-3">
    <div class="row">
        <div class="col-12 px-0">
            <div id="sliderGrafik" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class=" shadow-sm bg-white p-3">
                            <h6 class="card-subtitle mb-2 text-uppercase text-muted text-center">Grafik sebaran</h6>
                            <h6 class="card-title font-weight-bold text-center text-green">Industri Tekstik dan Produk Tekstil</h6>
                            <div class="canvas-container">
                                <canvas id="chartDesktop1"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class=" shadow-sm bg-white p-3">
                            <h6 class="card-subtitle mb-2 text-uppercase text-muted text-center">Grafik sebaran</h6>
                            <h6 class="card-title font-weight-bold text-center text-green">Industri Aneka Usaha Industri</h6>
                            <div class="canvas-container">
                                <canvas id="chartDesktop2"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class=" shadow-sm bg-white p-3">
                            <h6 class="card-subtitle mb-2 text-uppercase text-muted text-center">Grafik sebaran</h6>
                            <h6 class="card-title font-weight-bold text-center text-green">Industri Agro dan Aneka Pangan</h6>
                            <div class="canvas-container">
                                <canvas id="chartDesktop3"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class=" shadow-sm bg-white p-3">
                            <h6 class="card-subtitle mb-2 text-uppercase text-muted text-center">Grafik sebaran</h6>
                            <h6 class="card-title font-weight-bold text-center text-green">Semua Industri</h6>
                            <div class="canvas-container">
                                <canvas id="chartDesktop4"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#sliderGrafik" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon text-success" aria-hidden="true">
                        <svg width="2em" height="1.5em" viewBox="0 0 16 16" class="bi bi-caret-left-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.86 8.753l5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                        </svg>
                    </span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#sliderGrafik" role="button" data-slide="next">
                    <span class="carousel-control-next-icon text-success" aria-hidden="true">
                        <svg width="2em" height="1.5em" viewBox="0 0 16 16" class="bi bi-caret-right-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.14 8.753l-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                        </svg>
                    </span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</section>
<script>var ctx1=document.getElementById("chartDesktop1"),myChart=new Chart(ctx1,{type:"bar",data:{labels:[@foreach($kecamatan as $k) "{{$k->name}}", @endforeach],datasets:[{label:"Jml industri",data:[@foreach($graph['tipe1'] as $g) "{{$g}}", @endforeach],backgroundColor:["rgba(255, 99, 132, 0.2)","rgba(54, 162, 235, 0.2)","rgba(255, 206, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(153, 102, 255, 0.2)"],borderColor:["rgba(255, 99, 132, 1)","rgba(54, 162, 235, 1)","rgba(255, 206, 86, 1)","rgba(75, 192, 192, 1)","rgba(153, 102, 255, 1)"],borderWidth:1}]},options:{scales:{yAxes:[{ticks:{beginAtZero:!0},scaleLabel:{display:!0,labelString:"unit usaha"}}]}}});var ctx2=document.getElementById("chartDesktop2"),myChart=new Chart(ctx2,{type:"bar",data:{labels:[@foreach($kecamatan as $k) "{{$k->name}}", @endforeach],datasets:[{label:"Jml industri",data:[@foreach($graph['tipe2'] as $g) "{{$g}}", @endforeach],backgroundColor:["rgba(255, 99, 132, 0.2)","rgba(54, 162, 235, 0.2)","rgba(255, 206, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(153, 102, 255, 0.2)"],borderColor:["rgba(255, 99, 132, 1)","rgba(54, 162, 235, 1)","rgba(255, 206, 86, 1)","rgba(75, 192, 192, 1)","rgba(153, 102, 255, 1)"],borderWidth:1}]},options:{scales:{yAxes:[{ticks:{beginAtZero:!0},scaleLabel:{display:!0,labelString:"unit usaha"}}]}}});var ctx3=document.getElementById("chartDesktop3"),myChart=new Chart(ctx3,{type:"bar",data:{labels:[@foreach($kecamatan as $k) "{{$k->name}}", @endforeach],datasets:[{label:"Jml industri",data:[@foreach($graph['tipe3'] as $g) "{{$g}}", @endforeach],backgroundColor:["rgba(255, 99, 132, 0.2)","rgba(54, 162, 235, 0.2)","rgba(255, 206, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(153, 102, 255, 0.2)"],borderColor:["rgba(255, 99, 132, 1)","rgba(54, 162, 235, 1)","rgba(255, 206, 86, 1)","rgba(75, 192, 192, 1)","rgba(153, 102, 255, 1)"],borderWidth:1}]},options:{scales:{yAxes:[{ticks:{beginAtZero:!0},scaleLabel:{display:!0,labelString:"unit usaha"}}]}}});var ctx4=document.getElementById("chartDesktop4"),myChart=new Chart(ctx4,{type:"bar",data:{labels:[@foreach($kecamatan as $k) "{{$k->name}}", @endforeach],datasets:[{label:"Jml industri",data:[@foreach($graph['semua'] as $g) "{{$g}}", @endforeach],backgroundColor:["rgba(255, 99, 132, 0.2)","rgba(54, 162, 235, 0.2)","rgba(255, 206, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(153, 102, 255, 0.2)"],borderColor:["rgba(255, 99, 132, 1)","rgba(54, 162, 235, 1)","rgba(255, 206, 86, 1)","rgba(75, 192, 192, 1)","rgba(153, 102, 255, 1)"],borderWidth:1}]},options:{scales:{yAxes:[{ticks:{beginAtZero:!0},scaleLabel:{display:!0,labelString:"unit usaha"}}]}}});var ctx5=document.getElementById("chartDesktopFront"),myChart=new Chart(ctx5,{type:"bar",data:{labels:[@foreach($kecamatan as $k) "{{$k->name}}", @endforeach],datasets:[{label:"Jml industri",data:[@foreach($graph['semua'] as $g) "{{$g}}", @endforeach],backgroundColor:["rgba(255, 99, 132, 0.2)","rgba(54, 162, 235, 0.2)","rgba(255, 206, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(153, 102, 255, 0.2)"],borderColor:["rgba(255, 99, 132, 1)","rgba(54, 162, 235, 1)","rgba(255, 206, 86, 1)","rgba(75, 192, 192, 1)","rgba(153, 102, 255, 1)"],borderWidth:1}]},options:{scales:{yAxes:[{ticks:{beginAtZero:!0},scaleLabel:{display:!0,labelString:"unit usaha"}}]}}});</script>