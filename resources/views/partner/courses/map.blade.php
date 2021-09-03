@extends('layouts.web.app')

@section('breadcrumb')
    <div class="container main-padding">
        @include('_partials/breadcrumb',[
                'module'=> $enroll->course->name,
                'routes' =>[
                    [
                        'description' => __('breadcrumb.enrolls'),
                        'url' => route('web.enrolls')
                    ],
                    [
                        'description' => $enroll->course->name
                    ]
                ]
        ])
    </div>
@endsection

@section('content')

    <div class="container mb-5">

        @include('partner.courses.progress_bar',['enroll'=>$enroll])
        @include('partner.courses.certification_buttons',['enroll'=>$enroll])


        <div class="container-fluid mt-5">
            <section class="section ">
                <div class="row canvas">
                @foreach($enroll->course->chapters_tree as $chapter)
                    <!--Grid column-->
                        <div class="col-lg-4 col-md-12 mb-4 ">
                            <!--Card-->
                            <div class="object">
                                <div class="avatar mx-auto p-3">
                                    <img src="{{ asset('storage/'.$chapter->icon) }}"
                                         alt="avatar mx-auto white" class="img-fluid">
                                </div>

                                <div class="card bg-secondary-gradient  mt-0 position-relative">
                                    <!--Avatar-->
                                    <div class="card-body m-3 p-2">
                                        <!--Name-->
                                        <h3 class="card-title text-primary font-weight-bold">
                                            @if(app()->getLocale() === 'es')
                                                {{$chapter->original_title}}
                                            @else
                                                {{$chapter->localized_title}}
                                            @endif
                                        </h3>

                                        <div class="card-footer bg-transparent text-secondary text-center py-2">
                                            <a class="px-2 fa-lg li-ic"
                                               data-toggle="dropdown" aria-haspopup="true"
                                               aria-expanded="false"
                                            >
                                                <i class="fas fa-chevron-down text-secondary-two"></i>
                                            </a>
                                            <div class="dropdown-menu  dropdown-menu-center">
                                                <a href="{{route('web.enrolls.course',[$enroll->id]).'#chapterId='.$chapter->id}}"
                                                   class="dropdown-item btn-account-verification"
                                                >
                                                    <i class="fas fa-check"></i>
                                                    @if(app()->getLocale() === 'es')
                                                        {{$chapter->original_title}}
                                                    @else
                                                        {{$chapter->localized_title}}
                                                    @endif
                                                </a>
                                                @foreach($chapter->nodes as $children)
                                                    <a href="{{route('web.enrolls.course',[$enroll->id]).'#chapterId='.$children->id}}"
                                                       class="dropdown-item btn-account-verification">
                                                        <i class="fas fa-check"></i>

                                                        @if(app()->getLocale() === 'es')
                                                            {{$children->original_title}}
                                                        @else
                                                            {{$children->localized_title}}
                                                        @endif

                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Card-->
                        </div>
                        <!--Grid column-->
                    @endforeach
                </div>
            </section>
        </div>
    </div>
@endsection

@section('styles')
    {{Html::style(mix('css/plugins/simple-flow/simple-flow.css'))}}
    {{Html::style(mix('css/web/course/progress.css'))}}
@endsection
@section('scripts')
    {{--
    icons for later:
        https://www.flaticon.com/free-icon/lock_2913133?term=secure&page=1&position=73
        https://www.flaticon.com/free-icon/checked_214353

    See:
     https://www.jqueryscript.net/chart-graph/Flow-Chart-Plugin-jQuery-Bootstrap.html
     http://tutorials.jenkov.com/svg/marker-element.html

     Demo:
        https://www.jqueryscript.net/demo/Flow-Chart-Plugin-jQuery-Bootstrap
    --}}
    {{ Html::script(mix('js/plugins/simple-flow/simple-flow.js')) }}
    {{ Html::script(mix('js/web/course/progress/app.js')) }}
@endsection
