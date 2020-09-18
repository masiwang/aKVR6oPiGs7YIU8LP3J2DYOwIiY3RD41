<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <title>SIIDa Admin | @yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans+Narrow:wght@700&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
    <style>
        html, body{
            height:100%;
            widht:100%;
            border:0;
            margin:0;
            font-family: 'Roboto', sans-serif;
        }
        h1, h2, h3, h4, h5, h6{
            font-family: 'PT Sans Narrow', sans-serif;
        }
        .text-blue{
            color:#005bdb
        }
        .bg-top{
            position:absolute;
            top: 0;
            left: 0;
            z-index: -999;
            background-color: #1976d2;
            background: linear-gradient(145deg,#005bdb,#5d00ff);
            color: #fff;
            width:100%;
            height: 400px;
            -webkit-transform: skewY(2deg);
            transform: skewY(2deg);
            -webkit-transform-origin: 100%;
            transform-origin: 100%;
        }
        .bg-transparent-rodo{
            background-color: rgba(255, 255, 255, 0.2);
        }
        .table-industri{
            font-size:0.7em;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
</head>
<body id="top" style="background:#eee">
    <div class="bg-top"></div>
    @yield('content')
    <!-- Optional JavaScript -->
    <!-- Popper.js first, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
    </script>
</body>
<script>
    $("document").ready(function(){
        setTimeout(function(){
        $("div.flash").remove();
        }, 5000 );
    });
</script>
@yield('js')
</html>