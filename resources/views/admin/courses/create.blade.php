@extends('layouts.admin.app')
@section('breadcrumb')
    @include('_partials/breadcrumb',[
          'module'=>'Nuevo Curso',
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
                    'description'=>'Nuevo'
                ]
          ]
        ])
@endsection

@section('content')
    <div class="container shadow p-0 rounded">

        <!--Card -->
        <div class="card bg-transparent shadow-none p-0" id="cardCourse">
            <!--Card content -->
            <div class="card-body p-0">
                <!-- course  form -->
            {{ Form::open([
                'id' => 'frmCourse',
                'data-parsley-validate'=>true,
                'data-action'=>route('courses.store')
            ]) }}

            {{ Form::hidden('_method','POST') }}
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
