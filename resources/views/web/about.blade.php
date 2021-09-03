@extends('layouts.web.app')
@section('intro')
    <section class="intro view">
        <div class="mask rgba-black-slight white-text text-uppercase">


            <div id="video"></div>


            <div class="caption text-center text-lg-left d-flex flex-column flex-lg-row justify-content-between align-items-center">

                <div>
                    <h1 class="h1-responsive font-weight-bold">
                        {{__('web/about.intro_title')}}
                    </h1>
                    <h2 class="h2-responsive font-weight-bold mt-2">
                        {{__('web/about.intro_subtitle')}}
                    </h2>
                </div>

                <i class="fas fa-4x fa-play mt-3 mt-lg-0"></i>


            </div>

        </div>
    </section>
@endsection

@section('content')

    <!-- Section: About -->
    <section id="about" class="about mt-5 p-5 wow fadeIn text-center" data-wow-delay="0.2s">

        <div class="row wrap mt-5 mt-lg-0">

            <div class="col-12 col-lg-6">
                <h2 class="display-4 text-secondary font-weight-bold text-uppercase">
                <span class="title">
                    {{__('web/about.about_us_title')}}
                      <figure class="circle primary circle-md wow fadeInUpBig"></figure>
                </span>


                </h2>
            </div>
            <div class="col-12 col-lg-6 mt-3 mt-lg-0">
                <h3 class="h3-responsive text-secondary text-justify font-weight-bold">
                    {{__('web/about.about_us_caption')}}

                </h3>
            </div>

        </div>

    </section>
    <!-- Section: About -->

    <!-- Section: Vision -->

    <div class="row no-gutters mt-5 vision">
        <div class="col-12 col-lg-6 bg-main-gradient vision-section wow fadeInLeft">

            <div class="container">
                <h2 class="display-4 white-text font-weight-bold text-uppercase text-center">
                    {{__('web/about.mission')}}
                </h2>

                <p class="h4-responsive white-text mt-5">
                    {{__('web/about.mission_copy')}}
                </p>
            </div>

        </div>
        <div class="col-12 col-lg-6 bg-dark vision-section wow fadeInRight" data-wow-delay=".25s">
            <div class="container">
                <h2 class="display-4 white-text font-weight-bold text-uppercase text-center">
                    {{__('web/about.vision')}}
                </h2>

                <p class="h4-responsive white-text mt-5">
                    {{__('web/about.vision_copy')}}
                </p>
            </div>

        </div>
    </div>

    <!-- Section: Vision -->


@endsection


@section('styles')

    <link rel="stylesheet" href="{{asset(mix('css/web/about.css'))}}" >
@endsection


@section('scripts')
    <script type="text/javascript" async src="{{asset(mix('js/web/about.js'))}}"></script>

    <script type="text/javascript">

        $(function () {

            console.log('owa lacri');

        });

    </script>
@endsection
