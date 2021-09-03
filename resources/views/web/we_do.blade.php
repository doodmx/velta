@extends('layouts.web.app')
@section('intro')

@endsection

@section('content')



    <div class="mask main-padding">


    @include('_partials/components.all_brands')


        <!-- Grid row -->

        <div class="row no-gutters tech-business">
            <div class="gradient"></div>

            <!-- Grid col -->
            <div class="h-100 col-12 col-lg-5  d-flex  justify-content-center justify-content-lg-start align-items-center bg-white p-5">

                <h1 class="display-4 grey-text text-uppercase font-weight-bold wow pulse text-center text-lg-left"
                    data-wow-delay="0.25s">
                    {{__('web/we_do.main_title')}}
                </h1>

            </div>
            <!--Grid col -->

            <!-- Grid col -->
            <div class="h-100 col-12 col-lg-7 bg-main-gradient d-flex justify-content-center align-items-center wow fadeIn "
                 data-wow-delay=".25s">

                <div class="row no-gutters justify-content-center">
                    <div class="col-8 col-lg-10 col-xl-12">
                        <img src="https://cdn.veltacorp.com/img/ipad_velta.png" alt="Velta Negocio"
                             class="img-fluid wow zoomIn" data-wow-delay=".6s">
                    </div>
                </div>
            </div>
            <!-- Grid col -->

        </div>

        <!-- Grid row -->


        @foreach(__('web/we_do.slides') as $slide)

            @include('_partials/we_do/slide',[
                'sectionClass'=> $slide['bgClass'],
                'title' => $slide['title'],
                'copy' => $slide['copy'],
            ])
        @endforeach


    <!-- Brand header -->
        <div class="d-none d-lg-block">
            @include('_partials/components.all_brands')
        </div>
        <!-- Brand header-->
    </div>

@endsection


@section('styles')

    <link rel="stylesheet" href="{{asset(mix('css/web/we_do.css'))}}">
@endsection



