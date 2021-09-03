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

    <link rel="stylesheet" href="{{ asset(mix('css/admin_panel/app.css')) }}" media="none"
          onload="if(media!='all')media='all'">
    <noscript>
        <link rel="stylesheet" href="{{ asset(mix('css/admin_panel/app.css')) }}">
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


    {!! SEO::generate() !!}

    @yield('styles')


</head>
<body class="fixed-sn">
<!-- Main Navigation -->
<header>

@include('layouts.admin.left_sidebar')

@if(isset($addRightSidebar))
    @include('layouts.admin.right_sidebar',['title' => $rightSidebarTitle ])
@endif

<!-- Navbar -->
@include('layouts/admin/navbar')
<!-- Navbar -->
</header>
<!-- Main Navigation -->

<!-- Main layout -->
<main>

    @if(isset($addRightSidebar))
        <a href="#" data-activates="slide-out-right"
           class="btn-floating btn-primary collapse-right btn-lg"><i class="fas fa-bars text-tangaroa"></i></a>
    @endif

    <div class="container main-content" id="content">

        <div id="page-breadcrumb">
            @yield('breadcrumb')

        </div>

        <div id="page-content">
            @yield('content')
        </div>

    </div>
</main>
<!-- Main layout -->

<a id="DATA" data-url="{{URL::to('/')}}"></a>
<a id="app" data-url="{{url('/')}}" data-locale="{{app()->getLocale()}}"></a>

<!-- Scripts -->
<script type="text/javascript" src="{{asset(mix('js/admin_panel/manifest.js'))}}"></script>
<script type="text/javascript" src="{{asset(mix('js/admin_panel/vendor.js'))}}"></script>
<script type="text/javascript" src="{{asset(mix('js/admin_panel/app.js'))}}"></script>

@yield('scripts')

</body>
</html>
