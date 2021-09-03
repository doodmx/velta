@extends('layouts.admin.app')


@section('breadcrumb')

    @include('_partials/breadcrumb',[
          'module'=>'Publicaciones',
          'routes' =>[
                [
                  'description' => 'Inicio',
                  'url' => route('welcome')
              ],
              [
                  'description' => 'Publicaciones'
              ]

          ]
        ])

@endsection

@section('content')


    <div class="container shadow p-5 rounded">


        <div class="row align-items-center justify-content-between">

            @if(auth()->user()->hasPermissionTo('create_blog') || auth()->user()->hasRole('Super Admin') && app()->getLocale() === 'es')
                <a href="{{route('blogs.create')}}" class="btn btn-primary btn-rounded ">
                    <i class="fas fa-plus"></i> Nueva
                </a>
            @endif

            <div class="col-4 text-left">

                <label class="mdb-main-label" for="categorySelect">Categoría</label>
                {{ Form::select('',$categorySelect, null,[
                    'id' =>'categorySelect',
                    'placeholder'=>"Ver todas",
                    'class' => 'mdb-select md-form colorful-select dropdown-secondary'
                ]) }}
            </div>
        </div>

        {!! $dataTable->table(['width' => '100%']) !!}
    </div>

@endsection

@section('scripts')
    {!! $dataTable->scripts() !!}
    <script type="text/javascript" src="{{asset(mix('js/admin_panel/blog/index.js'))}}"></script>
@endsection()
