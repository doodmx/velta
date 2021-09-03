<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset(mix('css/web/app.css')) }}" rel="stylesheet">

    <link rel="shortcut icon" type="image/png" href="{{asset('img/azell_logo.png')}}">

    @yield('styles')

    {!! SEO::generate() !!}

    <style>

        .page-wrapper-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .page-wrapper-container .card {
            max-width: 500px;
        }

        .page-wrapper-container .card .logo {
            max-height: 120px;
            object-position: center;
            object-fit: cover;
            filter: invert(1);
        }
    </style>
</head>
<body class="intro-page azellft-lp">


<!-- Main content -->
<main>


    <!-- First container -->
    <div class="page-wrapper-container">
        @yield('content')
    </div>
    <!-- First container -->
</main>


</body>
</html>
