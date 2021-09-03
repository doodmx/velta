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
                  'description' => 'Categorías de Cursos'
              ]

          ]
        ])

@endsection

@section('content')
    <div class="container shadow p-5 rounded">

        <div class="row align-items-center justify-content-between">
            @if(auth()->user()->hasPermissionTo('create_course_category') || auth()->user()->hasRole('Super Admin') && app()->getLocale() === 'es')
                <a href="{{route('course_types.create')}}"
                   class="btn btn-primary btn-rounded"
                >
                    <i class="fas fa-plus text-tangaroa"></i> Nueva
                </a>
            @endif
            <div class="col-4 text-left">

                <label class="mdb-main-label" for="courseTypeStatus">Status</label>
                {{ Form::select('',$statusSelect, null,[
                    'id' =>'courseTypeStatus',
                    'class' => 'mdb-select md-form colorful-select dropdown-primary pt-2'
                ]) }}
            </div>
        </div>

        {!! $dataTable->table(['width' => '100%']) !!}
    </div>



@endsection

@section('scripts')

    {!! $dataTable->scripts() !!}
    <script type="text/javascript" src="{{asset(mix('js/admin_panel/course_type/index.js'))}}"></script>

@endsection
