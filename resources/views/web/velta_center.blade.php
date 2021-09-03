@extends('layouts.web.app')
@section('content')


    <div class="main-padding">

        <div class="row wrap container-fluid"> <!-- full-page-container -->
            <div class="col-12 col-lg-12 p-12 text-left bg-main-gradient d-flex flex-column justify-content-center align-items-center">
                <h1 class="h1-responsive text-white font-weight-bold">
                    {{__('web/velta_center.velta_office')}} 
                </h1>

                <img src="https://cdn.veltacorp.com/img/velta_business.png" alt="Velta Offices"
                     class="img-fluid img-rounded shadow wow zoomIn" data-wow-delay=".3s">

            </div>
            
        </div>

        <div class="row wrap container-fluid">
            <div class="row">
                <div class="col-12 col-lg-12 p-12 text-center bg-white d-flex flex-column justify-content-center align-items-center">
                    <h1 class="h1-responsive text-primary font-weight-bold">
                        {{__('web/velta_center.velta_mall')}}
                    </h1>

                    <img src="https://cdn.veltacorp.com/img/velta_address.png" alt="Velta Mall "
                        class="img-fluid img-rounded shadow wow zoomIn" data-wow-delay=".5s">
                </div>
            </div>
        </div> 


    </div>






    <!-- CONTACT FORMS  -->

    <div class="container-fluid mt-5">
        <div class="row ">
            <div class="col-12 col-lg-6 pr-lg-2">

                @include('_partials/components/contact_card')

            </div>
            <div class="col-12 col-lg-6 mt-3 mt-lg-0">
                @include('_partials/components/appointment_card')

            </div>
        </div>
    </div>


    <!-- CONTACT FORMS -->



@endsection


@section('styles')

    <link rel="stylesheet" href="{{asset(mix('css/web/projects.css'))}}">
@endsection

@section('scripts')

    <script type="text/javascript" src="{{asset(mix('js/web/projects.js'))}}"></script>
@endsection
