@extends('layouts.admin.app')

@section('breadcrumb')
    @include('_partials/breadcrumb',[
          'module'=>'Cursos',
          'routes' =>[
                [
                  'description' => 'Inicio',
                  'url' => route('welcome')
                ],
                [
                  'description' => 'Cursos',
                   'url' => route('courses.index')
                ]
          ]
        ])
@endsection



@section('content')
    <div class="container shadow p-5 rounded">


        @if(session()->has('course_error'))
            <div class="alert alert-danger mb-5">
                {{session()->get('course_error')}}
            </div>
        @endif

        <div class="row align-items-center justify-content-between">

            @if(auth()->user()->hasPermissionTo('create_course') || auth()->user()->hasRole('Super Admin') && app()->getLocale() === 'es')
                <a href="{{route('courses.create')}}"
                   class="btn btn-primary btn-rounded"
                >
                    <i class="fas fa-plus"></i> Nuevo
                </a>
            @endif

            <div class="col-4 text-left">
                {{Form::select('',$courseTypeSelect,null,['class'=>'mdb-select md-form colorful-select dropdown-secondary','id'=>"courseTypeSelect",'multiple','searchable'=>'Buscar categoría...'])}}
                <label for="courseTypeSelect" class="mdb-main-label">Categorías</label>
            </div>


            <div class="col-4 text-left">
                {{Form::select('',$statusSelect,'',['class'=>'mdb-select md-form colorful-select dropdown-secondary','id'=>"courseStatus"])}}
                <label class="mdb-main-label" for="courseStatus">Status</label>
            </div>
        </div>

        {!! $dataTable->table(['width' => '100%']) !!}
    </div>

    <a href="" id="localData" data-quiz_stored="{{request()->has('quizSaved')}}"></a>

@endsection

@section('scripts')

    {!! $dataTable->scripts() !!}
    <script type="text/javascript" src="{{asset(mix('js/admin_panel/course/index.js'))}}"></script>

@endsection()
