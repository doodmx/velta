<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <script async src="https://kit.fontawesome.com/8ab43cbc45.js" crossorigin="anonymous"></script>

    <!-- Styles -->

    <link rel="stylesheet" href="{{ asset(mix('css/web/app.css')) }}" media="none" onload="if(media!='all')media='all'" >
    <noscript>
        <link rel="stylesheet" href="{{ asset(mix('css/web/app.css')) }}" >
    </noscript>

    <link rel="apple-touch-icon" sizes="57x57" href="https://cdn.veltacorp.com/img/icons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="https://cdn.veltacorp.com/img/icons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="https://cdn.veltacorp.com/img/icons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="https://cdn.veltacorp.com/img/icons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="https://cdn.veltacorp.com/img/icons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="https://cdn.veltacorp.com/img/icons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="https://cdn.veltacorp.com/img/icons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="https://cdn.veltacorp.com/img/icons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="https://cdn.veltacorp.com/img/icons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"
          href="https://cdn.veltacorp.com/img/icons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://cdn.veltacorp.com/img/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="https://cdn.veltacorp.com/img/icons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://cdn.veltacorp.com/img/icons/favicon-16x16.png">
    <link rel="manifest" href="https://cdn.veltacorp.com/img/icons/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="https://cdn.veltacorp.com/img/icons/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    @yield('styles')

<!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-171822798-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-171822798-1');
    </script>


    {!! SEO::generate() !!}
</head>
<body>
{{-- ********** BEGIN HEADER SECTION ********** --}}
<header>
    <!-- Intro -->
@yield('intro')
<!-- Intro -->
</header>
{{-- ********** END HEADER SECTION ********** --}}


{{-- ********** BEGIN CONTENT SECTION ********** --}}
<main>
    @yield('content')
</main>
{{-- ********** END CONTENT SECTION ********** --}}



<a id="app" data-url="{{url('/')}}"></a>


{{-- ********** BEGIN SCRIPTS SECTION **********--}}
<script src="{{ asset(mix('js/web/manifest.js')) }}"></script>
<script src="{{ asset(mix('js/web/vendor.js')) }}"></script>
<script src="{{ asset(mix('js/web/app.js')) }}"></script>


@yield('scripts')
{{-- ********** END SCRIPTS SECTION **********--}}
</body>
</html>
