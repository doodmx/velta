@extends('layouts.web.app')


@section('breadcrumb')
    <div class="container main-padding">
        @include('_partials/breadcrumb',[
                'module'=> __('breadcrumb.certification'),
                'routes' =>[
                    [
                        'description' => 'Mis Cursos',
                        'url' => route('web.enrolls')
                    ],
                    [
                        'description' => $quiz->chapter->course->name,
                         'url' => route('web.enrolls.course.map',$quiz->chapter->parent_course_id)
                    ],
                    [
                        'description' => __('breadcrumb.certification_quiz')
                    ]
                ]
        ])
    </div>
@endsection

@section('content')
    <div class="container my-5">

        <div class="row no-gutters">

            <div class="col-12">

                <!-- QUIZ HEADER-->
                <h1 class="text-primary font-weight-bold mb-0 d-flex justify-content-between">
                    <div class="d-block">
                        {{$quiz->localized_name}}
                    </div>
                    <div class="d-block lead white-text">
                        {{$quiz->total_credits}} {{__('courses/quiz.points')}}
                    </div>

                </h1>


                <h3 class="h3-responsive text-secondary-two mt-4">
                    {{__('courses/quiz.advice_copy')}}  {{$quiz->credits_to_approve}}   {{__('courses/quiz.points')}}
                </h3>

                <p class="lead text-secondary-three mt-2">
                    {{__('courses/quiz.briefing')}}: {{$quiz->localized_briefing}}
                </p>
                <!--QUIZ HEADER-->

                {{Form::open(['id'=>'frmQuiz','url'=>route('web.enrolls.quiz.store',request()->segment(2)),'data-parsley-validate' => true,'class'=>'mt-5'])}}


                @foreach($quiz->questions as $question)

                    <div class="row {{$loop->index > 0 ? 'mt-5':''}}">

                        <div class="col-12">
                            <!-- QUESTION -->
                            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-center">
                                <h4 class="h4-responsive text-primary font-weight-bold">
                                    {{$loop->index+1}}.- {{$question->localized_name}}
                                </h4>
                                <div class="badge badge-secondary-two p-2 lead">
                                    {{$question->credits}} {{__('courses/quiz.points')}}
                                </div>
                            </div>
                            <!-- QUESTION -->

                            <!-- QUESTION OPTIONS -->
                            <!-- RADIO OPTION -->
                            @if($question->type === 'radio')
                                @foreach($question->options as $option)

                                    <label class="has-error" id="error{{$question->id}}radio-a{{$option->id}}"></label>
                                    <div class="form-check mt-3">
                                        <input
                                            id="q{{$question->id}}radio-a{{$option->id}}"
                                            name="answers[{{$question->id}}][]"
                                            data-question="{{$question->id}}"
                                            data-answer="{{$option->id}}"
                                            class="form-check-input question-option"
                                            type="radio"
                                            value="true"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#error{{$question->id}}radio-a{{$option->id}}"
                                        >
                                        <label class="lead form-check-label text-secondary-two"
                                               for="q{{$question->id}}radio-a{{$option->id}}">
                                            {{$option->localized_option}}
                                        </label>
                                    </div>
                                @endforeach
                            @endif
                        <!-- RADIO OPTION -->

                            <!-- CHECKBOX OPTION -->
                            @if($question->type === 'checkbox')
                                @foreach($question->options as $option)
                                    <label class="has-error" id="error{{$question->id}}check-a{{$option->id}}"></label>
                                    <div class="form-check mt-3">
                                        <input
                                            id="q{{$question->id}}check-a{{$option->id}}"
                                            name="answers[{{$question->id}}][]"
                                            data-question="{{$question->id}}"
                                            data-answer="{{$option->id}}"
                                            class="form-check-input question-option"
                                            type="checkbox"
                                            value="true"
                                            data-parsley-required="true"
                                            data-parsley-errors-container="#error{{$question->id}}check-a{{$option->id}}"
                                        >
                                        <label class="form-check-label text-secondary-two lead"
                                               for="q{{$question->id}}check-a{{$option->id}}">
                                            {{$option->localized_option}}
                                        </label>
                                    </div>
                            @endforeach
                        @endif
                        <!-- CHECKBOX OPTION -->
                            <!-- QUESTION OPTIONS -->

                            <hr class="bg-gray my-5">

                        </div>

                    </div>
                @endforeach

                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-primary btn-rounded btn-lg font-weight-bold"
                            id="saveQuiz">
                        <i class="fas fa-envelope mr-2"></i> {{__('courses/quiz.send')}}
                    </button>
                </div>

                {{Form::close()}}
            </div>
        </div>

    </div>
    <a href="#"
       id="localData"
       data-quiz="{{$quiz}}"
       data-enroll="{{request()->segment(2)}}">
    </a>
@endsection

@section('scripts')
    <script src="{{asset(mix('js/web/course/quiz/app.js'))}}"></script>
@endsection
