<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
    <meta charset="utf-8">
    <meta name="robots" content="noindex,nofollow">
    <meta name="name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ mix('/assets/css/app.css') }}">
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
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <meta name="description" content="Application de gestion des formations.">
    <link rel="stylesheet" type="text/css" href="{{ asset('/backend/css/admin.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">

    @yield('head')

    <script>
        var _auth = <?php echo json_encode(Auth::user()->api_token); ?>;
    </script>

    <style media="screen">
        a#menu-toggle {
            position: relative;
            float: left;
            left: 10px;
            font-size: 30px;
            margin-right: 15px;
            color: black;
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <div id="app">
            @include('admin/includes/sidebar')

            <div id="page-content-wrapper" >
                <a href="#" id="menu-toggle" class="visible-xs">
                    <i class="ion-android-funnel"></i>
                </a>
                @yield('body')
            </div>
        </div>
    </div>


    <script src="{{ asset('/backend/js/scripts.js') }}"></script>
    <script src="{{ asset('/backend/js/admin.js') }}"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://unpkg.com/vue-multiselect@2.1.0"></script>

    <script>
      $("#menu-toggle").click(function(e) {
          e.preventDefault();
          $("#wrapper").toggleClass("toggled");
      });

      $(function () {
          $('[data-toggle="tooltip"]').tooltip()
      });

      $(function(){
          $('.table tr[data-href]').each(function(){
              $(this).css('cursor','pointer').hover(
                  function(){
                      $(this).addClass('active');
                  },
                  function(){
                      $(this).removeClass('active');
                  }).click( function(){
                      document.location = $(this).attr('data-href');
                  }
              );
          });
      });
    </script>
    @yield('js')
</body>
</html>
