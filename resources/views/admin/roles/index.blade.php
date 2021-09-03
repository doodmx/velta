@extends('layouts.admin.app')

@section('breadcrumb')

    @include('_partials/breadcrumb',[
          'module'=>'Roles de Usuario',
          'routes' =>[
                [
                  'description' => 'Inicio',
                  'url' => route('welcome')
              ],
              [
                  'description' => 'Roles'
              ]

          ]
        ])


@endsection
@section('content')
    <div class="container shadow p-5 rounded">

        <div class="row align-items-center justify-content-between">

            @if(auth()->user()->hasPermissionTo('create_role') || auth()->user()->hasRole('Super Admin'))
                <a href="{{route('roles.create')}}"
                   class="btn btn-primary btn-rounded font-weight-bold"
                >
                    <i class="fas fa-plus"></i> Nuevo
                </a>
                @endif
                </h1>

            <div class="col-4 text-left">
                {{Form::select('',$statusSelect,'',['class'=>'mdb-select md-form colorful-select dropdown-secondary pt-2','id'=>"roleStatus"])}}
                <label class="mdb-main-label" for="roleStatus">Status</label>
            </div>
        </div>

        {!! $dataTable->table(['width' => '100%']) !!}
    </div>

@endsection

@section('scripts')

    {!! $dataTable->scripts() !!}
    <script type="text/javascript" src="{{asset(mix('js/admin_panel/role/index.js'))}}"></script>

@endsection()
