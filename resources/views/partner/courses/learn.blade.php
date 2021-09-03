@extends('layouts.web.app')

@section('breadcrumb')

    <div class="main-padding container">
        @include('_partials/breadcrumb',[
            'module'=> $enroll->course->name,
            'routes' =>[
                [
                    'description' => __('breadcrumb.enrolls'),
                    'url' => route('web.enrolls')
                ],
                [
                    'description' => $enroll->course->name,
                    'url' => route('web.enrolls.course.map',$enroll->course->id)
                ]
            ]
        ])
    </div>

@endsection

@section('content')



    <div class="container">

        @if(request()->session()->has('enroll_success'))

            <div class="alert alert-secondary-two" role="alert">
                {{session('enroll_success')}}
            </div>

        @endif

        @if(request()->session()->has('enroll_error'))

            <div class="alert alert-primary" role="alert">
                {{session('enroll_error')}}
            </div>

        @endif


        <div class="card  shadow-none bg-transparent">

            <div class="card-body px-0">


                <p class="lead text-secondary-two mt-3">
                    {{$enroll->course->excerpt}}
                </p>

                @include('partner.courses.progress_bar',['enroll'=>$enroll])

                @include('partner.courses.certification_buttons',['enroll'=>$enroll])




                <div class="row mt-5 no-gutters">
                    <div class="col-12">
                        <div class="embed-responsive embed-responsive-16by9 video-container">
                            <iframe src="https://player.vimeo.com/video/392076340?title=0&byline=0&portrait=0"
                                    class="embed-responsive-item w-100 video"
                                    frameborder="0"
                                    allow="autoplay; fullscreen"
                                    webkitallowfullscreen
                                    mozallowfullscreen
                                    allowfullscreen
                            >
                            </iframe>

                            <div class="video-controls">

                                <div class="title bg-primary text-white font-weight-bold p-2 m-1 m-lg-3">

                                </div>

                                <div class="controls">
                                    <div class="control control-prev">
                                        <i class="fa fas fa-step-backward"></i>
                                    </div>
                                    <div class="control play-control">
                                        <i class="fa fas fa-play-circle"></i>
                                    </div>

                                    <div class="control control-next">
                                        <i class="fa fas fa-step-forward"></i>
                                    </div>
                                </div>


                            </div>

                            <div class="next-video d-none">

                                <h3 class="text-primary title">

                                </h3>
                                <div class="next-progress">
                                    <div class="circle">
                                        <i class="fas fa-step-forward text-primary"></i>
                                    </div>
                                </div>

                                <button class="btn btn-outline btn-primary btn-rounded btn-sm mt-3">
                                    {{__('courses/learn.cancel')}}

                                </button>

                            </div>

                        </div>
                    </div>

                </div>

                @include('_partials/course/detail/content',['course'=> $enroll->course])
            </div>
        </div>


    </div>
    <a href="#"
       id="localData"
       data-enroll="{{$enroll->id}}"
       data-chapters="{{$enroll->course->chapters_tree}}"
    ></a>
@endsection


@section('styles')
    {{Html::style(asset(mix('css/web/course/learn.css')))}}
@endsection


@section('scripts')
    <script src="{{ asset(mix('js/web/course/learn/app.js')) }}"></script>
@endsection
