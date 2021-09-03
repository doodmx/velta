@extends('layouts.admin.app')


@section('breadcrumb')


    @include('_partials/breadcrumb',[
          'module'=>'Reportes',
          'routes' =>[
                [
                  'description' => 'Inicio',
                  'url' => route('welcome')
              ],
              [
                  'description' => 'Usuarios',
                  'url' => route('users.index')
              ],
              [
                  'description' =>'Detalle de Inversión ',
                  'url' => route('users.investment.show', [auth()->user()->id])
              ],
              [
                  'description' =>'Reportes',
              ]
          ]
        ])

@endsection


@section('content')

    @include('admin.users.investment.reports.modals.create_or_update')

    <div class="container shadow p-5 rounded">
        <div class="row align-items-center justify-content-between">
            @if((auth()->user()->hasPermissionTo('create_user_investment_report') || auth()->user()->hasRole('Super Admin')) && app()->getLocale() === 'es')
                <button class="btn btn-primary btn-rounded"
                        id="openModalReport">
                    <i class="fas fa-plus text-tangaroa"></i> Nuevo
                </button>
            @endif
        </div>
        {!! $dataTable->table(['class'=>'table table-striped dataTable','width' => '100%']) !!}
    </div>

@endsection

@section('styles')
    <style>
        @media (min-width: 1200px) and (min-width: 992px){
            .modal .modal-full-height.modal-lg {
                width: 50vw!important;
                max-width: 50vw!important;
            }
        }
    </style>
@endsection

@section('scripts')
    {!! $dataTable->scripts() !!}

    <script type="text/javascript">
        let investment = @json($investment[0]);
    </script>
    <script type="text/javascript" src="{{asset(mix('js/admin_panel/user/investment/report/app.js'))}}"></script>
@endsection()
