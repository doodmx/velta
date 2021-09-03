@extends('layouts.admin.app')

@section('breadcrumb')

    @include('_partials/breadcrumb',[
         'module'=>'Estadísticas del Sitio',
         'routes' =>[
               [
                 'description' => 'Inicio',
                 'url' => route('welcome')
             ],
             [
                 'description' => 'Estadísticas del Sitio'
             ]

         ]
       ])

@endsection

@section('content')

    <div class="main-padding container">

        @include('_partials/analytics/search')
        @include('_partials/analytics/general_charts')
        @include('_partials/analytics/general_stats')
        @include('_partials/analytics/conversions')
        @include('_partials/analytics/pages_stats')

    </div>
@endsection

@section('styles')
    {{Html::style('https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css')}}
@endsection
@section('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>



    <script type="text/javascript" src="{{asset(mix('js/admin_panel/analytics.js'))}}"></script>


@endsection

