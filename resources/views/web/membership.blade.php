@extends('layouts.web.app')

@section('content')

    <div class="main-padding">


        @include('_partials/membership/header')
        @include('_partials/membership/formats')

        @include('_partials/membership/calculator')
        @include('_partials/membership/plans')
        @include('_partials/membership/velta_app')


        <div class="container-fluid my-5">
            <div class="row no-gutters justify-content-center">
                <div class="col-12 col-lg-6 pr-lg-2">

                    @include('_partials/components/contact_card')

                </div>
                <div class="col-12 col-lg-6 mt-3 mt-lg-0">
                    @include('_partials/components/appointment_card')

                </div>
            </div>
        </div>


    </div>

@endsection


@section('styles')

    <link rel="stylesheet" href="{{asset(mix('css/web/membership.css'))}}">
@endsection


@section('scripts')
    <script type="text/javascript" async src="{{asset(mix('js/web/contact.js'))}}"></script>
    <script type="text/javascript" async src="{{asset(mix('js/web/membership.js'))}}"></script>

@endsection
