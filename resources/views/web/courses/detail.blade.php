@extends('layouts.web.app')


@section('content')

<div class="course-container main-padding px-lg-5 mb-5">


        <div class="row justify-content-between no-gutters">


            <div class="col-12 col-lg-8">

                @include('_partials/course/detail/header',['course'=> $course])
                @include('_partials/course/detail/content',['course'=> $course])
                @include('_partials/course/detail/reviews',['reviews'=> $course->enrolls->whereNotNull('rate')])


            </div>


            <div class="col-12 col-lg-4 pl-lg-3">
                @include('_partials/course/detail/price_card',['course'=> $course])
            </div>

        </div>

    </div>

@endsection


@section('styles')

    {{Html::style(asset(mix('css/web/course/detail.css')))}}

@endsection

@section('scripts')
    <script src="{{ asset(mix('js/web/course/index.js')) }}"></script>
    <script src="{{ asset(mix('js/web/course/detail.js')) }}"></script>
@endsection
