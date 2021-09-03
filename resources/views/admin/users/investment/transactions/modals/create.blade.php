{{ Form::open([
    'id' => 'frmTransaction',
    'data-parsley-validate'=>true,
    'autocomplete' => 'off'
]) }}

@method('POST')


<div class="modal fade right modal-right modal-notify "
     id="modalCreateTransaction" tabindex="-1" role="dialog"
     aria-labelledby="transactionModal"

     aria-hidden="true">
    <div class="modal-dialog modal-full-height modal-right modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h5 class="modal-title text-primary font-weight-bold">Nueva Transacción</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <h4 class="ml-3">Información General</h4>
                    <div class="col-sm-12">
                        <section class="card profile-card mb-4">
                            <!-- Card content -->
                            <div class="card-body">
                                <div class="row my-1">
                                    <div class="col-12 col-sm-4 text-center text-sm-left m-auto">
                                        <p class="text-uppercase h6 mb-0 ">Inversionista</p>
                                    </div>
                                    <div class="col-12 col-sm-8 text-center text-sm-right m-auto">
                                        <h5 class="font-weight-bold dark-grey-text my-0">
                                            <strong>{{$user->profile->name . ' ' .$user->profile->lastname}}</strong>
                                        </h5>
                                    </div>
                                </div>

                                <div class="row my-1">
                                    <div class="col-12 col-sm-4 text-center text-sm-left m-auto">
                                        <p class="text-uppercase h6 mb-0">Membresia</p>
                                    </div>
                                    <div class="col-12 col-sm-8 text-center text-sm-right m-auto">
                                        <h5 class="font-weight-bold dark-grey-text my-0">
                                            <img width="48" height="48"
                                                 src="https://cdn.veltacorp.com/img/icons/membership/{{$user->membership}}.svg"
                                                 alt="">
                                            <h6 class="text-capitalize py-0 my-0">{{$user->membership}}</h6>
                                        </h5>
                                    </div>
                                </div>
                                <div class="row my-1">
                                    <div class="col-12 col-sm-4 text-center text-sm-left m-auto">
                                        <p class="text-uppercase h6 mb-0">Periodo de Inversión</p>
                                    </div>
                                    <div class="col-12 col-sm-8 text-center text-sm-right m-auto">
                                        <h5 class="font-weight-bold dark-grey-text my-0">
                                            {{$investment[0]->start_date->format('d-m-Y')}}
                                            al {{$investment[0]->end_date->format('d-m-Y')}}
                                        </h5>
                                    </div>
                                </div>

                                <div class="row my-1">
                                    <div class="col-12 col-sm-4 text-center text-sm-left m-auto">
                                        <p class="text-uppercase h6 mb-0">Status</p>
                                    </div>
                                    <div class="col-12 col-sm-8 text-center text-sm-right m-auto">
                                        <h5 class="font-weight-bold dark-grey-text my-0">
                                            <span class="badge badge-pill text-capitalize {{$investment[0]->status=='on_progress' ? 'badge-success': 'badge-primary'}}">
                                                {{__('api/investment.'.$investment[0]->status)}}
                                            </span>
                                        </h5>
                                    </div>
                                </div>

                                <!-- Title -->
                               {{--
                                <div class="text-center">
                                    <h4 class="card-title">
                                        <strong>{{$user->profile->name . ' ' .$user->profile->lastname}}</strong>
                                    </h4>
                                </div>
                                <p class="text-primary text-center py-0 my-0">Inversionista</p>
                                <div class="text-center">
                                    <img width="48" height="48"
                                         src="https://cdn.veltacorp.com/img/icons/membership/{{$user->membership}}.svg"
                                         alt="">
                                    <h6 class="text-capitalize text-center py-0 my-0">{{$user->membership}}</h6>
                                </div>
                                <div class="text-center">
                                    <p class="text-primary py-0 my-0">Periodo de Inversión</p>
                                    <p>
                                        {{$investment[0]->start_date->format('d-m-Y')}}
                                        al {{$investment[0]->end_date->format('d-m-Y')}}
                                    </p>
                                </div>
                                <div class="text-center">
                                    <p class="text-primary py-0 my-0">Status</p>
                                    <p>
                                        <span class="badge badge-pill text-capitalize {{$investment[0]->status=='on_progress' ? 'badge-success': 'badge-primary'}}">
                                            {{__('api/investment.'.$investment[0]->status)}}
                                        </span>
                                    </p>
                                </div>
                                --}}
                            </div>
                        </section>
                    </div>
                    <h4 class="ml-3">Transacción</h4>
                    <div class="col-sm-12">
                        <div class="row my-1">
                            <div class="col-4 m-auto">
                                <p class="text-uppercase h6 mb-0 text-left">Inversión</p>
                            </div>
                            <div class="col-8 m-auto">
                                <h4 class="font-weight-bold dark-grey-text text-right my-0">
                                    <span id="textBalance"></span> {{$investment[0]->currency->iso_code}}
                                </h4>
                            </div>
                        </div>
                        <div class="row my-1">
                            <div class="col-4 m-auto">
                                <p class="text-uppercase h6 mb-0 text-left">Rendimiento</p>
                            </div>
                            <div class="col-8 m-auto">
                                <h4 class="font-weight-bold dark-grey-text text-right my-0">
                                    +<span id="textProfit"></span> {{$investment[0]->currency->iso_code}}
                                </h4>
                            </div>
                        </div>
                        <div class="row my-1">
                            <div class="col-4 m-auto">
                                <p class="text-uppercase h6 mb-0 text-left">Retiros</p>
                            </div>
                            <div class="col-8 m-auto">
                                <h4 class="font-weight-bold dark-grey-text text-right my-0">
                                    -<span id="textWithdrawal"></span> {{$investment[0]->currency->iso_code}}
                                </h4>
                            </div>
                        </div>
                        <hr>{{--Validar el status de la inversión si el status es finalizado  el saldo disponible debe de ser el total --}}
                        <div class="row my-1">
                            <div class="col-4 m-auto">
                                <p class="text-uppercase h6 mb-0 text-left font-weight-bold">Disponible</p>
                            </div>
                            <div class="col-8 m-auto">
                                <h4 class="font-weight-bold dark-grey-text text-right my-0">
                                    <span id="textAvailable"></span> {{$investment[0]->currency->iso_code}}
                                </h4>
                            </div>
                        </div>
                        <div class="row my-1">
                            <div class="col-4 m-auto">
                                <select class="mdb-select md-form" name="type" id="selectType">
                                    <option value="withdrawal" selected>Retiro</option>
                                    <option value="deposit">Deposito</option>
                                    <!--<option value="profit">Rendimiento</option>-->
                                </select>
                                <label class="mdb-main-label">Tipo</label>
                            </div>
                            <div class="col-8 m-auto">
                                <div class="md-form form-group my-0 d-flex">
                                    <h4 class="font-weight-bold dark-grey-text text-right my-auto">
                                        $
                                    </h4>

                                    {{ Form::text('amount', null, [
                                        'placeholder' => '0.00',
                                        'class' => 'form-control input-transaction',
                                        'id' => 'txtAmount',
                                        'data-parsley-required' => true,
                                        'data-parsley-balance' => true,
                                        'data-parsley-errors-container'=>'#errorAmount'
                                    ]) }}
                                    <h4 class="font-weight-bold dark-grey-text text-right my-auto">
                                        {{$investment[0]->currency->iso_code}}
                                    </h4>
                                </div>
                            </div>

                            <div class="red-text font-small text-right col" role="alert" id="errorAmount"></div>
                        </div>
                        <hr>
                        <div class="row my-1">
                            <div class="col-4 m-auto">
                                <p class="text-uppercase h6 mb-0 text-left">Saldo Final</p>
                            </div>
                            <div class="col-8 m-auto">
                                <h4 class="font-weight-bold dark-grey-text text-right my-0">
                                    <span id="textTotal"></span> {{$investment[0]->currency->iso_code}}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top">
                <button type="button" class="btn btn-md btn-secondary btn-rounded waves-effect" data-dismiss="modal">
                    <i class="fas fa-times"></i> Cerrar
                </button>
                <button type="submit" class="btn btn-md btn-primary btn-rounded waves-effect">
                    <i class="fas fa-check"></i> Aplicar
                </button>
            </div>
        </div>
    </div>
</div>

{{ Form::close() }}
