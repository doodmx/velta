@extends('layouts.admin.app')

@section('breadcrumb')
    @include('_partials/breadcrumb',[
          'module'=>'Editar Curso',
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
                    'description'=> $course->name
                ]
          ]
        ])
@endsection

@section('content')
    <div class="container shadow p-0 rounded">


        <!--Card -->
        <div class="p-0 m-0" id="cardCourse">
            <!--Card content -->
            <div class="card-body p-0">
                <!-- course  form -->
            {{ Form::open([
                'id' => 'frmCourse',
                'data-parsley-validate'=>true,
                'data-action'=>route('courses.update', [ 'id'=> isset($course) ? $course->id : null ])
            ]) }}
            {{ Form::hidden('_method','PATCH') }}
            @include('admin.courses.fields')
            {{ Form::close() }}


            <!-- course form -->
            </div>
        </div>
        <!--Card -->
    </div>

@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/4.14.0/standard-all/ckeditor.js"></script>
    <script src="{{ asset(mix('js/admin_panel/course/app.js')) }}"></script>
@endsection()
