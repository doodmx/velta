@extends('layouts.admin.app')

@section('breadcrumb')
    @include('_partials/breadcrumb',[
          'module'=>'Histórico de Pagos',
          'routes' =>[
                [
                  'description' => 'Inicio',
                  'url' => route('welcome')
                ],
                [
                  'description' => 'Histórico de Pagos',
                   'url' => route('admin.payments.index')
                ]
          ]
        ])
@endsection

@section('content')

    @include('admin.payments.email')

    <div class="container shadow p-5 rounded">


        <div class="row mb-3 justify-content-end mt-5 ">
            <div class="col-4 text-left">
                {{Form::select('',$currencies,null,['class'=>'mdb-select md-form colorful-select dropdown-secondary','id'=>"currencySelect",'multiple','searchable'=>'Buscar moneda...'])}}
                <label for="courseTypeSelect" class="mdb-main-label">Moneda</label>
            </div>


            <div class="col-4 text-left">
                {{Form::select('',['paid'=>'Pagados','all'=>'pendientes'],null,['class'=>'mdb-select md-form colorful-select dropdown-secondary','id'=>"paymentStatus",'placeholder'=>"Ver todos"])}}
                <label class="mdb-main-label" for="courseStatus">Status</label>
            </div>
        </div>

        {!! $dataTable->table(['width' => '100%']) !!}
    </div>

@endsection

@section('scripts')

    {!! $dataTable->scripts() !!}
    <script type="text/javascript" src="{{asset(mix('js/admin_panel/payments/index.js'))}}"></script>

@endsection()
