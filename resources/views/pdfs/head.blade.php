<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>{{ config('app.name') }} - {{ $title ?? '' }}</title>
    <style>
        @page {
            size: A4 portrait;
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
        .card { background-color: #efefef; border-radius: 2px }
        .accent { background-color: #efefef; font-weight: bold }
        .teal { color: #636d7e }
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

        .grey { background-color: #eaeaea }
        .greyer { background-color: #d4d4d4 }
        .page-break { page-break-after: always; }
    </style>
</head>
