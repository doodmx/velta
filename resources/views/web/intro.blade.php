@extends('layouts.web.app')
@section('content')

    <div class="main-padding">

        <!-- Brand header -->
        <div class="row wrap no-gutters brand-header justify-content-between align-items-center p-3 wow fadeInLeft">

            <div class="flex-shrink-1">
                <img data-src="https://cdn.veltacorp.com/img/velta_corto.png" class="d-block mx-auto">
            </div>

            <div class="text-center">

                <a href="" class="d-block d-md-inline-block lead text-secondary">
                    {{__('web/intro.description')}}
                </a>

                <a href="" class="d-block d-md-inline-block lead text-secondary mt-2 mt-md-0 mx-md-3">
                    {{__('web/intro.why')}}
                </a>

                <button class="btn btn-primary btn-sm btn-rounded mt-2 open-chat" data-message="Hola buen día, quiero informes para invertir en el proyecto SHELTEC">
                    {{__('web/intro.cta_invest')}}
                </button>
            </div>

        </div>
        <!-- Brand header-->


        <!-- Brand content -->
        <section class="view jarallax brand-content">

            <img class="jarallax-img"
                 data-src="https://cdn.veltacorp.com/img/fondo_sheltec.jpg"
                 alt="Sheltec">

            <div class="mask rgba-white-slight">

                <div class="container">

                    <!-- SHELTEC COPY HEADER -->
                    <div class="row pt-5 justify-content-between align-items-center wow fadeInDown"
                         data-wow-delay=".25s">

                        <div class="col-12 col-lg-6 text-center">
                            <h1 class="display-4 intro-header font-weight-bold">
                                {{__('web/intro.legend')}}
                            </h1>
                        </div>

                        <div class="col-12 col-lg-5 mt-3">
                            <p class="text-justify lead text-secondary font-weight-bold">
                                {{__('web/intro.copy')}}
                            </p>

                        </div>
                    </div>
                    <!-- SHELTEC COPY HEADER -->

                    <!-- VIDEO CONTAINER-->
                    <div class="row no-gutters d-flex align-items-center mt-5">

                        <!-- VIDEO PLAYER -->
                        <div class="col-12 col-xl-6 d-flex justify-content-center mt-3 mt-xl-0 order-2 order-xl-1 wow fadeInLeft" data-wow-delay=".15s">

                            <div class="play-control play-control-intro d-flex align-items-center justify-content-center">
                                <i class="fas fa-play"></i>
                            </div>

                            <div class="project-video device device-silver">
                                <div class="device-frame">
                                    <div id="video"></div>
                                    <img class="device-content" src="https://cdn.veltacorp.com/img/previo_sheltec.jpg">


                                </div>
                                <div class="device-stripe"></div>
                                <div class="device-header"></div>
                                <div class="device-sensors"></div>
                                <div class="device-btns"></div>
                                <div class="device-power"></div>
                            </div>

                        </div>
                        <!-- VIDEO PLAYER -->

                        <!-- VIDEO CAPTION -->
                        <div class="col-12 col-xl-6 order-1 order-xl-2">
                            <div class="video-caption video-intro rounded p-5 wow slideInRight" data-wow-delay=".3s">

                                <h5 class="h5-responsive text-white font-weight-bold text-uppercase">
                                    {{__('web/intro.why')}}
                                </h5>

                                <p class="text-white font-weight-bold mt-3">
                                    {{__('web/intro.video_caption')}}
                                </p>

                            </div>
                        </div>
                        <!-- VIDEO CAPTION -->


                    </div>
                    <!-- VIDEO CONTAINER-->

                </div>

            </div>

        </section>


        <!-- CONTACT FORMS  -->

        <div class="container-fluid my-5">
            <div class="row mt-5">
                <div class="col-12 col-lg-6 pr-lg-2">

                    @include('_partials/components/contact_card')

                </div>
                <div class="col-12 col-lg-6 mt-3 mt-lg-0">
                    @include('_partials/components/appointment_card')

                </div>
            </div>
        </div>


        <!-- CONTACT FORMS -->

    </div>

@endsection


@section('styles')

    <link rel="stylesheet" href="{{asset(mix('css/web/projects.css'))}}">
@endsection

@section('scripts')

    <script type="text/javascript" src="{{asset(mix('js/web/projects.js'))}}"></script>
@endsection
