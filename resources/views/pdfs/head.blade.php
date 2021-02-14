<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    var InputCentre = document.getElementById('Centre').value
    var InputNord = document.getElementById('Nord').value
    var InputNordOuest = document.getElementById('NordOuest').value
    var InputAdamaoua = document.getElementById('Adamaoua').value
    var InputEst = document.getElementById('Est').value
    var InputOuest = document.getElementById('Ouest').value
    var InputLittoral = document.getElementById('Littoral').value
    var InputSud = document.getElementById('Sud').value
    var InputExtremeNord = document.getElementById('ExtremeNord').value
    var InputSudOuest = document.getElementById('SudOuest').value

    var Centre = JSON.parse(InputCentre);
    var Nord = JSON.parse(InputNord);
    var NordOuest = JSON.parse(InputNordOuest);
    var Adamaoua = JSON.parse(InputAdamaoua);
    var Est = JSON.parse(InputEst);
    var Ouest = JSON.parse(InputOuest);
    var Littoral = JSON.parse(InputLittoral);
    var Sud = JSON.parse(InputSud);
    var ExtremeNord = JSON.parse(InputExtremeNord);
    var SudOuest = JSON.parse(InputSudOuest);

    function drawChart () {

      var data = google.visualization.arrayToDataTable([
        ['Région', 'Commune touchée'],
        [Adamaoua.name,  Adamaoua.commune_touchees.length],
        [Centre.name, Centre.commune_touchees.length],
        [Est.name,  Est.commune_touchees.length],
        [ExtremeNord.name,  ExtremeNord.commune_touchees.length],
        [Littoral.name,  Littoral.commune_touchees.length],
        [Nord.name,  Nord.commune_touchees.length],
        [NordOuest.name,  NordOuest.commune_touchees.length],
        [Ouest.name,  Ouest.commune_touchees.length],
        [Sud.name, Sud.commune_touchees.length],
        [SudOuest.name, SudOuest.commune_touchees.length]
      ]);

      var options = {
        title: 'POURCENTAGE DE MAIRES TOUCHES PAR REGIONS',
        is3D: true,
      };

      var chart_div = document.getElementById('piechart_1');
      var chart = new google.visualization.PieChart(chart_div);
      // Wait for the chart to finish drawing before calling the getImageURI() method.
        google.visualization.events.addListener(chart, 'ready', function () {
          chart_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
          console.log(chart_div.innerHTML);
        });

      chart.draw(data, options);
    }
    </script>
    <title>{{ config('app.name') }} - {{ $title ?? '' }}</title>
    <style>
        @page {
            size: A4 paysage;
        }

        * {
            margin: 0;
            padding: 0;
            font-family:  "Open Sans", "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
            line-height: 1.6;
            -webkit-box-sizing: border-box;
        }



        h4,h3 {font-weight: 300; color: #353847; margin: 0;}

        body {
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
            margin: 0 auto;
            font-family: sans-serif;
            font-size: 11px;
            font-weight: 400;
        }

        .bold { font-weight: bold }
        .list-unstyled { list-style: none; color: #636d7e; }
        .mt-5 { margin-top: 5px }
        .mt-10 { margin-top: 10px }
        .mt-20 { margin-top: 20px }
        .mt-40 { margin-top: 40px }
        .text-right { text-align: right }
        .text-center { text-align: center }
        .text-wrap { word-wrap: break-word }
        .card { background-color: #efefef; border-radius: 2px }
        .accent { background-color: #efefef; font-weight: bold }
        .teal { color: #636d7e }
        .red { color: #f32f55 }
        .bg-teal { background-color: #ccc }
        table {  }
        table > thead { border-top: 2px solid #ccc; border-bottom: 2px solid #ccc }
        table > tbody > tr > td { padding: 3px 3px; border: 1px solid #777; }
        table.table-white > tbody > tr > td { padding: 3px 3px; border: none; }
        input[type=checkbox] { display: inline; }

        .table { display: table; width: 100% }
        .table-row { display: table-row }
        .table-cell { display: table-cell }
        .col1 { width: 70% }
        .col2 { width: 50% }
        .col3 { width: 33% }
        .red { color: red }
        .fs-16 { font-size: 16px }
        .fs-14 { font-size: 14px }

        .tr-section { background-color:#d4d4d4; color:#000; font-weight:bold;}
        .td-section { background-color:#d4d4d4; color:#000; font-weight:bold; }
        .td-title { background-color: #eaeaea; font-size: 13px }
        .td-100 { width:100% }
        .td-85 { width:85% }
        .td-80 { width:80% }
        .td-70 { width:70% }
        .td-60 { width:60% }
        .td-50 { width:50% }
        .td-45 { width:45% }
        .td-40 { width:40% }
        .td-35 { width:35% }
        .td-30 { width:30% }
        .td-25 { width:25% }
        .td-20 { width:20% }
        .td-15 { width:15% }
        .td-10 { width:10% }
        .td-7 { width:7% }
        .td-5 { width:5% }
        .td-3 { width:3% }
        .td-2 { width:2% }
        .mt-10 { margin-top: 10px }

        .grey { background-color: #eaeaea }
        .greyer { background-color: #d4d4d4 }
        .page-break { page-break-after: always; }
    </style>
</head>
