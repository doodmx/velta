@extends('layouts.web.app')

@section('breadcrumb')

    <div class="main-padding container">
        @include('_partials/breadcrumb',[
            'module'=> __('breadcrumb.my_investors'),
            'routes' =>[
                [
                    'description' => __('breadcrumb.my_investors'),
                ]

            ]
        ])
    </div>

@endsection

@section('content')


    @include('admin.users.modals.profile')



    <div class="container rounded">

        <div class="row pb-5">
            <div class="col-12">
                <a href="{{route('investments.create')}}"
                   class="btn btn-primary btn-rounded waves-effect waves-light float-right clearfix">
                    <i class="fas fa-plus text-tangaroa"></i>
                    {{__('my_investors.add')}}
                </a>
            </div>
            <div class="col-12">
                {!! $dataTable->table(['width' => '100%']) !!}
            </div>
        </div>
    </div>

    <a href="#" id="localData" data-role="{{auth()->user()->roles[0]->name}}"></a>
@endsection

@section('styles')
    {{Html::style('https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css')}}
@endsection
@section('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    {!! $dataTable->scripts() !!}


    <script type="text/javascript" src="{{asset(mix('js/admin_panel/user/index/app.js'))}}"></script>

@endsection
