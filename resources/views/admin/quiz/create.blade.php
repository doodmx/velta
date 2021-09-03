@extends('layouts.admin.app',['addRightSidebar' => true,'rightSidebarTitle'=>'Orden de las Preguntas'])


@section('right_sidebar_items')
    <ul class="collapsible collapsible-accordion" id="questions-menu"></ul>
@endsection

@section('breadcrumb')
    @include('_partials/breadcrumb',[
          'module'=>'Cuestionario del Curso',
          'routes' =>[
                [
                  'description' => 'Inicio',
                  'url' => route('welcome')
                ],
                [
                  'description' => 'Cursos',
                   'url' => route('courses.index')
                ],
                [
                  'description' => $course->name,
                   'url' => route('courses.edit',$course->id)
                ],
                [
                   'description' => 'Cuestionario'
                ]
          ]
        ])
@endsection

@section('content')


    <!-- Modal -->
    <form id="addQuestionForm">
        <div class="modal fade" id="addQuestionModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLongTitle" aria-hidden="true" style="z-index: 99999;">
            <div class="modal-dialog " role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom">
                        <h3 class="modal-title text-primary font-weight-bold">
                            Nuevo Reactivo
                        </h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">


                        <div class="row align-items-center">
                            <div class="col-12">
                                <div class="md-form">
                                    <input type="text"
                                           name="question"
                                           class="form-control form-control-lg "
                                           data-parsley-required="true"

                                    >
                                    <label for="question">Pregunta</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="md-form">
                                    <input type="text"
                                           name="question_credits"
                                           class="form-control form-control-lg "
                                           data-parsley-required="true"
                                           data-parsley-type="number"
                                    >
                                    <label for="question">Nº de puntos</label>
                                </div>
                            </div>
                            <div class="col-12">


                                {{Form::select('question_type',[
                                  'radio' =>'Radio',
                                  'checkbox' => 'Casillas de Verificación'
                                  ],
                                  null,
                                  [
                                  'class'=>'select-wrapper mdb-select md-form colorful-select dropdown-secondary',
                                  'placeholder'=>"Tipo de pregunta",
                                  'data-parsley-required' => true
                                  ])}}


                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-rounded" data-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit"
                                class="btn btn-secondary btn-rounded">
                            Agregar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <div class="container p-5 shadow rounded" id="quiz-wrapper">


        <div class="d-flex justify-content-end">
            @if(app()->getLocale() === 'es')
                <button
                    type="button"
                    class="btn btn-primary btn-lg btn-rounded"
                    data-toggle="modal"
                    data-target="#addQuestionModal"
                >
                    <i class="fas fa-question mr-2"></i> Nueva Pregunta
                </button>
            @endif


        </div>

        <form id="frmSaveQuiz">
            <div class="module-content">

                <div id="quiz-general"></div>

                <section id="questionsSection" class="mt-5">


                    <h3 class="h3-responsive text-secondary-two font-weight-bold">PREGUNTAS</h3>
                    <hr class="my-3">
                    <div id="questions"></div>

                </section>

            </div>
            <hr class="my-5">
            <div class="d-flex justify-content-end">
                <button type="button"
                        id="btnSaveQuiz"
                        class="btn btn-primary btn-lg btn-rounded"
                >
                    <i class="fas fa-save mr-2"></i>Guardar
                </button>
            </div>

        </form>

    </div>

@endsection




@section('scripts')
    <script type="text/javascript" src="{{asset(mix('js/admin_panel/quiz/app.js'))}}"></script>
@endsection()
