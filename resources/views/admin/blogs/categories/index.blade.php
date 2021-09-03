@extends('layouts.admin.app')

@section('breadcrumb')

    @include('_partials/breadcrumb',[
          'module'=>'Categorías',
          'routes' =>[
                [
                  'description' => 'Inicio',
                  'url' => route('welcome')
              ],
              [
                  'description' => 'Categorías'
              ]

          ]
        ])

@endsection

@section('content')
    @include('admin.blogs.categories.modal')

    <div class="container shadow p-5 rounded">



        <div class="row align-items-center justify-content-between">

            @if((auth()->user()->hasPermissionTo('create_category') || auth()->user()->hasRole('Super Admin')) && app()->getLocale() === 'es')
                <button class="btn btn-primary btn-rounded"
                        id="openCategoryModal">
                    <i class="fas fa-plus"></i> Nueva
                </button>
            @endif

            <div class="col-4 text-left">
                {{Form::select('',$statusSelect,'',['class'=>'mdb-select md-form colorful-select dropdown-secondary','id'=>"categoryStatus"])}}
                <label class="mdb-main-label" for="tagStatus">Status</label>
            </div>
        </div>


        {!! $dataTable->table(['class'=>'table table-striped dataTable','width' => '100%']) !!}
    </div>

@endsection

@section('scripts')


    {!! $dataTable->scripts() !!}

    <script type="text/javascript" src="{{asset(mix('js/admin_panel/category/app.js'))}}"></script>

@endsection()
