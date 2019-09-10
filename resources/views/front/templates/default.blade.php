<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="index,follow">
    <meta name="author" content="{{ config('app.name') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ mix('/assets/css/app.css') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta name="description" content="Looking for great rates and a trusted car hire company in Sydney? At XMD Rentals, you can find great rates & special deals on all car rentals.">
    @include('front.includes.mobile')
    @include('front.includes.analytics')
    @yield('head')

</head>
<body>
    <div id="app">
        <div class="has-fixed-nav">
            <nav class="navbar navbar-default navbar-fixed-top">
                @include('front.includes.nav')
            </nav>

            @yield('body')
            @include('front.includes.footer')
        </div>
    </div>
</body>

@if(config('app.environment') !== 'local')
    <script src="//code.tidio.co/y5p5xtkspfjewohbdhjykef5ovl2ybu8.js"></script>
@endif

{{-- <script src="{{ asset('/assets/js/app.js') }}"></script> --}}
<script src="{{ mix('/assets/js/manifest.js') }}"></script>
<script src="{{ mix('/assets/js/vendor.js') }}"></script>
<script src="{{ mix('/assets/js/app.js') }}"></script>

<script>
$(document).ready(function () {
    $('#scroller').on('click', function () {
        $('html, body').animate({ scrollTop: 0 }, "slow")
    })
})
</script>

@yield('js')
</html>
