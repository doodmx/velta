@extends('layouts.admin.app')


@section('breadcrumb')


    @include('_partials/breadcrumb',[
          'module'=>'Movimientos',
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
                  'url' => route('users.investment.show', [$investment[0]->user_id])
              ],
              [
                  'description' =>'Movimientos',
              ]
          ]
        ])

@endsection


@section('content')
    @include('admin.users.investment.transactions.modals.create')

    <div class="container shadow p-5 rounded">
        <div class="row align-items-center justify-content-between">
            @if((auth()->user()->hasPermissionTo('create_user_investment_transaction') || auth()->user()->hasRole('Super Admin')) && app()->getLocale() === 'es')
                <button class="btn btn-primary btn-rounded"
                        id="openModalCreateTransaction">
                    <i class="fas fa-plus text-tangaroa"></i> Nuevo
                </button>
            @endif
        </div>
        {!! $dataTable->table(['class'=>'table table-striped dataTable','width' => '100%']) !!}
    </div>

@endsection

@section('styles')
    <style>
        .input-transaction {
            font-size: 1.35rem;
            text-align: right;
            padding-right: 10px !important;
            font-weight: 700 !important;
            font-family: "Akzidenz", Arial, "Helvetica Neue", Helvetica, sans-serif !important;
            color: #4f4f4f !important;
        }

        #errorAmount {
            margin-top: -21px !important;
        }
        @media (min-width: 1200px) and (min-width: 992px){
            .modal .modal-full-height.modal-lg {
                width: 40vw!important;
                max-width: 40vw!important;
            }
        }
    </style>
@endsection

@section('scripts')
    {!! $dataTable->scripts() !!}

    <script type="text/javascript">
        let investment = @json($investment[0]);
    </script>
    <script type="text/javascript" src="{{asset(mix('js/admin_panel/user/investment/transaction/app.js'))}}"></script>
@endsection()
