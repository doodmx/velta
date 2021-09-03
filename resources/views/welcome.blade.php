@extends('layouts.'.$layout.'.app')

@section('content')

    <section class="intro view" style="position: absolute;top:0;left:0;height: 100vh; width: 100%">
        <div class="mask">
            <div class="h-100 d-flex">

                <!-- Presentation -->

                <!-- CONQUER THE WORLD -->
                <div class="h-100 col-12 col-lg-6 bg-main-gradient  main-padding px-lg-5">

                    <div
                        class="h-100 col-12 col-lg-8 d-flex flex-column justify-content-start justify-content-sm-center wow fadeInDown">

                        <h1 class="h2-responsive white-text text-uppercase font-weight-bolder wow fadeIn"
                            data-wow-delay="0.3s">
                            {{__('web/index.slide_title')}}
                        </h1>
                        <p class="lead white-text wow fadeIn mt-4 text-justify" data-wow-delay="0.3s">
                            {{__('web/index.slide_description')}}
                        </p>
                        <br>
                    </div>

                </div>
                <!-- CONQUER THE WORLD -->


                <!-- START A NEW JOURNEY -->
                <div class="h-100 col-6 bg-secondary-gradient main-padding d-none d-lg-block slider-banner">


                    <div class="welcome-card shadow rounded p-3">
                        <div class="card-body">

                            <h1 class="h3-responsive text-primary font-weight-bold d-flex align-items-center">
                                <div class="d-inline-flex">
                                    {{__('web/index.welcome')}}
                                </div>
                                <div class="d-inline-flex mx-3">
                                    <img src="https://cdn.veltacorp.com/img/velta_corto.png" alt="" class="img-fluid">
                                </div>
                                <div class="d-inline-flex">
                                    Partners
                                </div>
                            </h1>

                            <p class="lead text-secondary wow fadeIn mt-4 text-justify" data-wow-delay="0.3s">
                                {{__('web/index.banner_title_copy')}}
                            </p>

                            <button class="btn btn-primary btn-lg btn-rounded font-weight-bold float-right clearfix">
                                <i class="fas fa-start ml-2"></i> {{__('web/index.welcome_cta')}}
                            </button>
                        </div>
                    </div>
                </div>
                <!--START A NEW JOURNEY -->


            </div>
        </div>
    </section>

@endsection

@section('styles')

    <link rel="stylesheet" href="{{asset(mix('css/welcome.css'))}}">

@endsection

