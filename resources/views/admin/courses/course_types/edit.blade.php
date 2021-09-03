@extends('layouts.admin.app')

@section('breadcrumb')

    @include('_partials/breadcrumb',[
          'module'=>'Categorías de Cursos',
          'routes' =>[
                [
                  'description' => 'Inicio',
                  'url' => route('welcome')
                ],
                [
                  'description' => 'Categorías de Cursos',
                   'url' => route('course_types.index')
                ],
                [
                    'description' =>  $courseType->name
                ]

          ]
        ])

@endsection
@section('content')
    <div class="container shadow p-0 rounded">

        {{ Form::open([
                       'id' => 'frmCourseType',
                       'data-parsley-validate'=>true,
                       'data-id'=>request()->segment(3)
                   ]) }}

        {{ Form::hidden('_method','PATCH') }}
        @include('admin.courses.course_types.fields')

        {{ Form::close() }}
    </div>
@endsection

@section('scripts')
    <script src="{{ asset(mix('js/admin_panel/course_type/app.js')) }}"></script>
@endsection()
