@extends('layouts.web.welcome')

@section('content')
<style>
        .loading_1 {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: 1s all;
            opacity: 0;
        }
        .loading_1.show_1 {
            opacity: 1;
        }
        .loading_1 .spin {
            border: 3px solid hsla(185, 100%, 62%, 0.2);
            border-top-color: #3cefff;
            border-radius: 50%;
            width: 3em;
            height: 3em;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }            
    </style>
<div id="spin_v" class="loading_1 show_1">
    <div class="spin"></div>
</div>
    <section class="intro view">
        <div class="mask">
            <div class="h-100 d-flex">

                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg scrolling-navbar  z-depth-0 fixed-top navbar-light ml-md-4 mr-md-3 bg-transparent wow slideInDown ">
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent-4"
                            aria-controls="navbarSupportedContent-4" aria-expanded="false"
                            aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}">

                        @if(auth()->guest())
                            <picture>
                                <source media="(max-width:599.98px)" srcset="https://cdn.veltacorp.com/img/velta_corto.png">
                                <source media="(min-width:600px)" srcset=" https://cdn.veltacorp.com/img/velta_logo.png">
                                <img src=" https://cdn.veltacorp.com/img/velta_logo.png" alt="{{ config('app.name', 'Velta') }}"
                                     style="width:auto;">
                            </picture>
                        @else
                            <img src=" https://cdn.veltacorp.com/img/velta_corto.png" alt="{{ config('app.name', 'Velta') }}"
                                 style="width:auto;">
                        @endif
                    </a>
                    <div class="collapse navbar-collapse p-4 p-lg-0" id="navbarSupportedContent-4">
                        <ul class="navbar-nav ml-auto text-uppercase smooth-scroll">
                            @include('layouts.web.menu')
                        </ul>
                    </div>

                    @include('layouts.language_dropdown')
                </nav>
                <!-- Navbar -->

                <!-- Presentation -->

                <!-- CONQUER THE WORLD -->
                <div class="h-100 col-12 col-lg-6 bg-main-gradient  main-padding px-lg-5">

                    <div class="h-100 col-12 col-lg-8 d-flex flex-column justify-content-start justify-content-sm-center wow fadeInDown">

                        <h1 class="h2-responsive white-text text-uppercase font-weight-bolder wow fadeIn"
                            data-wow-delay="0.3s">
                            {{__('web/index.slide_title')}}
                        </h1>
                        <p class="lead white-text wow fadeIn mt-4 text-justify" data-wow-delay="0.3s">
                            {{__('web/index.slide_description')}}
                        </p>
                        <br>

                        <a href="{{route('we_do')}}" class="btn btn-primary white-text btn-rounded font-weight-bold wow fadeIn"
                           data-wow-delay="0.3s">
                            {{__('web/index.slide_cta')}}
                        </a>
                    </div>

                </div>
                <!-- CONQUER THE WORLD -->


                <!-- START A NEW JOURNEY -->
                <div class="h-100 col-6 bg-secondary-gradient main-padding d-none d-lg-block slider-banner">

                    <div class="banner-container wow fadeIn" data-wow-delay=".5s">

                        <div class="col-6 h-100 banner-title gradient p-5 rounded shadow">

                            <h3 class="h3-responsive text-secondary text-uppercase font-weight-bold text-left">
                                {{__('web/index.banner_title')}}
                            </h3>
                            <p class="lead mt-3">
                                {{__('web/index.banner_title_copy')}}
                            </p>

                            <a  href="{{route('membership')}}" class="btn btn-outline-secondary btn-rounded">
                                {{__('web/index.banner_title_cta')}}
                            </a>
                        </div>
                        <div class="col-6 h-100 banner-caption gradient p-5 rounded shadow d-flex flex-column justify-content-center">

                            <h3 class="h2-responsive text-white text-uppercase font-weight-bold text-left">
                                {{__('web/index.banner_caption')}}
                            </h3>


                            <p class="text-tertiary border-bottom  border-tertiary pb-5 mt-5 font-weight-bold lead">
                                QUERÉTARO 2020
                            </p>


                        </div>
                    </div>
                </div>
                <!--START A NEW JOURNEY -->

                <!-- Presentation -->

                <!--Footer -->
                <footer class="text-center text-md-left pt-0 text-white bg-transparent wow slideInUp">

                    <div class="container-fluid">

                        <!-- Grid row -->
                        <div class="row wrap  align-items-center py-3">

                            <!-- Legal links -->
                            <div class="col-12 col-sm-6 text-center text-md-left">
                                <div class="font-weight-bold d-lg-inline-block">
                                    © {{date('Y')}} {{__('web/index.rights')}}
                                </div>
                                <div class="mt-2 mt-lg-0 ml-0 ml-xl-5 font-weight-bold d-xl-inline-block ">
                                    <a href="{{route('policies')}}" class="white-text font-weight-bold">
                                        {!! __('web/footer.privacy_policy') !!}
                                    </a>
                                </div>
                                <div class="mt-2 mt-lg-0 ml-0 ml-xl-5  mb-lg-0 d-xl-inline-block ">
                                    <a href="{{route('terms')}}" class="white-text font-weight-bold">
                                        {!! __('web/footer.terms_of_use') !!}
                                    </a>
                                </div>
                            </div>

                            <!-- Legal links -->

                            <!-- RRSS & APP LINKS -->
                            <div class="col-12 col-sm-6 text-center text-sm-right">

                                <div class="rrss d-inline-block d-sm-block d-lg-inline-block">
                                    @foreach(config('social') as $social)
                                        <a class="fa-2x fb-ic"
                                           href="{{$social['url']}}"
                                           target="_blank">
                                            <i class="{{$social['icon']}} text-secondary mr-2 mr-lg-4"> </i>
                                        </a>
                                    @endforeach

                                </div>

                                <div class="d-inline-block d-sm-block d-lg-inline-block mt-3 mt-lg-0 ml-lg-4">
                                    <a href="https://apps.apple.com/us/app/dood-velta/id1522729629" class="ml-4 d-inline-block">
                                        <img src="https://cdn.veltacorp.com/img/app_store.svg" alt="Aplicacion Velta"
                                             width="32"
                                             height="32">
                                    </a>

                                    <a href="https://play.google.com/store/apps/details?id=com.dood.veltacorp" class="ml-4 d-inline-block">
                                        <img src="https://cdn.veltacorp.com/img/playstore_icon.svg" alt="Aplicacion Velta"
                                             width="32"
                                             height="32">
                                    </a>
                                </div>


                            </div>
                            <!-- RRSS & APP LINKS--->
                        </div>
                        <!-- Grid row -->
                    </div>


                </footer>

                <!--Footer-->

            </div>
        </div>
        
    </section>
@endsection


@section('styles')

    <link rel="stylesheet" href="{{asset(mix('css/web/index.css'))}}">

@endsection

@section('scripts')
<script>
    

    $(document).ready(function(){ 
        console.log( "window loaded" );
        // $('.loading_1').removeClass('show_1');
        // $('#spin_v').hide()
    });

    $(window).on('load', function(){
        console.log('Hola')
        $('.loading_1').removeClass('show_1');
        $('#spin_v').hide()
    });

    
</script>

@endsection


