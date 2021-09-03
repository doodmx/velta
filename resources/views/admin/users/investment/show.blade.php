@extends('layouts.admin.app')

@section('breadcrumb')

    @include('_partials/breadcrumb',[
          'module'=>'Detalle de Invesión',
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
              ]
          ]
        ])


    <div class="row">

        <div class="col-sm-12 text-right">
            <a href="{{route('users.investment.transactions',[$investment[0]->user_id,$investment[0]->id])}}" class="btn btn-primary btn-rounded waves-effect waves-light">
                <i class="fas fa-sync"></i>
                Movimientos
            </a>
            <a href="{{route('users.investment.reports',[$investment[0]->user_id,$investment[0]->id])}}" class="btn btn-secondary btn-rounded waves-effect waves-light">
                <i class="fas fa-file-import"></i>
                Reportes
            </a>
        </div>
    </div>

@endsection

@section('content')
    <section>
        <!-- Grid row -->
        <div class="row mt-5">
            <!-- Grid column -->
            <div class="col-lg-3 col-md-12">
                <!-- Section: Basic Info -->
                <section class="card profile-card mb-4 text-center">
                    <div class="avatar z-depth-1-half">
                        <img src="{{isset($user->profile->photo) ? 'https://cdn.veltacorp.com/img/avatar.svg' : url('storage/'.$user->profile->photo)}}"
                             alt="" width="132" height="132" class="img-fluid">
                    </div>
                    <!-- Card content -->
                    <div class="card-body">
                        <!-- Title -->
                        <h4 class="card-title">
                            <strong>{{$user->profile->name . ' ' .$user->profile->lastname}}</strong></h4>
                        <p class="text-primary text-center py-0 my-0">Velta Membership</p>
                        <div class="text-center">
                            <img width="48" height="48"
                                 src="https://cdn.veltacorp.com/img/icons/membership/{{$user->membership}}.svg"
                                 alt="">
                            <h6 class="text-capitalize text-center py-0 my-0">{{$user->membership}}</h6>
                        </div>
                        <hr>
                        <div class="text-center">
                            <p class="text-primary py-0 my-0">Periodo de Inversión</p>
                            <p>
                                {{$investment[0]->start_date->format('d-m-Y')}}
                                al {{$investment[0]->end_date->format('d-m-Y')}}
                            </p>
                        </div>
                        <hr>
                        <div class="text-center">
                            <p class="text-primary py-0 my-0">Status</p>
                            <p>
                                        <span class="badge badge-pill text-capitalize {{$investment[0]->status=='on_progress' ? 'badge-success': 'badge-primary'}}">
                                            {{__('api/investment.'.$investment[0]->status)}}
                                        </span>
                            </p>
                        </div>
                        <hr>
                        <ul class="list-unstyled my-0">
                            <li>
                                <h6 class="my-0">
                                    <a class="btn-floating btn-sm btn-primary" target="_blank"
                                       href="https://wa.me/{{str_replace('+','',$user->profile->whatsapp)}}?text=Informes Velta">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                    <span>{{$user->profile->whatsapp}}</span>
                                </h6>
                            </li>
                            <hr class="my-1">
                            <li>
                                <h6 class="my-0">
                                    <a class="btn-floating btn-sm btn-secondary" target="_blank"
                                       href="mailto:{{$user->email}}">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                    <span>{{$user->email}}</span>
                                </h6>
                            </li>
                        </ul>
                    </div>
                </section>
            </div>

            <div class="col-lg-9 col-md-12">
                <div class="card card-cascade narrower">
                    <!-- Card image -->
                    <div class="view view-cascade gradient-card-header secondary-color">
                        <h2 class="card-header-title">Portafolio de Inversión</h2>
                    </div>
                    <!-- Card image -->

                    <!-- Card content -->
                    <div class="card-body card-body-cascade">
                        <div class="row">
                            <!-- Grid column -->
                            <div class="col-xs-12 col-sm-3">
                                <!-- Card -->
                                <div class="card card-cascade cascading-admin-card text-center">
                                    <!-- Card Data -->
                                    <div class="admin-up">
                                        <i class="far fa-money-bill-alt secondary-color z-depth-2 p-3"
                                           aria-hidden="true"></i>
                                        <div class="data mt-3 text-center">
                                            <p class="text-uppercase mb-0">Inversión</p>
                                            <h4 class="font-weight-bold dark-grey-text">
                                                ${{number_format($investment[0]->balance,2,'.', ',')}} {{$investment[0]->currency->iso_code}}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card -->
                            </div>
                            <!-- Grid column -->

                            <!-- Grid column -->
                            <div class="col-xs-12 col-sm-3">
                                <!-- Card -->
                                <div class="card card-cascade cascading-admin-card text-center">
                                    <!-- Card Data -->
                                    <div class="admin-up">
                                        <i class="far fa-money-bill-alt success-color z-depth-2 p-3"
                                           aria-hidden="true"></i>
                                        <div class="data mt-3 text-center">
                                            <p class="text-uppercase mb-0">Rendimiento</p>
                                            <h4 class="font-weight-bold dark-grey-text">
                                                ${{number_format($investment[0]->profit,2,'.', ',')}} {{$investment[0]->currency->iso_code}}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card -->
                            </div>
                            <!-- Grid column -->

                            <!-- Grid column -->
                            <div class="col-xs-12 col-sm-3">
                                <!-- Card -->
                                <div class="card card-cascade cascading-admin-card text-center">
                                    <!-- Card Data -->
                                    <div class="admin-up">
                                        <i class="far fa-money-bill-alt danger-color z-depth-2 p-3"
                                           aria-hidden="true"></i>
                                        <div class="data mt-3 text-center">
                                            <p class="text-uppercase mb-0">Retiros</p>
                                            <h4 class="font-weight-bold dark-grey-text">
                                                ${{number_format($investment[0]->withdrawal,2,'.', ',')}} {{$investment[0]->currency->iso_code}}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card -->
                            </div>
                            <!-- Grid column -->

                            <!-- Grid column -->
                            <div class="col-xs-12 col-sm-3">
                                <!-- Card -->
                                <div class="card card-cascade cascading-admin-card text-center">
                                    <!-- Card Data -->
                                    <div class="admin-up">
                                        <i class="far fa-money-bill-alt primary-color z-depth-2 p-3"
                                           aria-hidden="true"></i>
                                        <div class="data mt-3 text-center">
                                            <p class="text-uppercase mb-0">Saldo Total</p>
                                            <h4 class="font-weight-bold dark-grey-text">
                                                @php
                                                    $available = ($investment[0]->balance + $investment[0]->profit) - $investment[0]->withdrawal;
                                                    $available = number_format($available, 2, '.', ',');
                                                @endphp
                                                ${{$available}} {{$investment[0]->currency->iso_code}}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card -->
                            </div>
                            <!-- Grid column -->
                        </div>

                        <div class="row">
                            <div class="col">
                                <canvas id="profitChart" width="400" height="250"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- Card content -->
                </div>

            </div>
            <!-- Grid column -->

        </div>
        <!-- Grid row -->

    </section>

@endsection

@section('styles')
    <style>
        .profile-card .avatar {
            max-width: 150px;
            max-height: 150px;
            margin-top: -50px;
            margin-left: auto;
            margin-right: auto;
            border-radius: 50%;
            overflow: hidden;
        }

        .cascading-admin-card .admin-up .data {
            float: none !important;
        }

        @media (min-width: 1200px){
            .container-xl, .container-lg, .container-md, .container-sm, .container {
                max-width: 1250px!important;
            }
        }
    </style>
@endsection
@section('scripts')
    <script type="text/javascript">
        const transactions = @json($investment[0]->transactions);
    </script>
    <script type="text/javascript" src="{{asset(mix('js/admin_panel/user/investment/app.js'))}}"></script>
@endsection()
