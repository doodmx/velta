{{ Form::open([
'id' => 'frmReport',
'data-parsley-validate'=>true,
'autocomplete' => 'off'
]) }}
<div class="modal fade right modal-right modal-notify "
     id="modalReport" tabindex="-1" role="dialog"
     aria-labelledby="reportModal"
     aria-hidden="true">
    <div class="modal-dialog modal-full-height modal-right modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h5 class="modal-title text-primary font-weight-bold">Nuevo Reporte</h5>
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
                            </div>
                        </section>
                    </div>
                </div>
                <div class="row">
                    <!-- FILE -->
                    <div class="col-12 col-lg-6 mt-3 mt-lg-0">
                        <h4>Reporte</h4>
                        <div class="card-body shadow rounded edit-context-menu"
                             style="height: 10rem;"
                             id="containerIdCard">
                            <div class="card-container d-flex flex-column justify-content-center align-items-center h-100">
                                <a href="#"
                                   target="_blank">
                                    <i class="far fa-file-pdf fa-3x text-danger"></i>
                                    <h5 class="mt-3 mb-0 text-secondary  font-weight-bold">
                                        PFD
                                    </h5>
                                    <p id="textFilename" class="mt-1  text-secondary-two font-small">
                                    </p>
                                </a>
                            </div>

                            <div class="file-field position-absolute" style="top:0px;right:10px;">
                                <a class="btn-floating btn-secondary">
                                    <i class="fas fa-paperclip" aria-hidden="true"></i>
                                    <input
                                            id="file"
                                            type="file"
                                            name="file"
                                            data-parsley-required="true"
                                            data-parsley-filemaxmegabytes="2"
                                            data-parsley-trigger="change"
                                            data-parsley-filemimetypes="application/pdf"
                                            data-parsley-errors-container="#errorPdf"
                                    >
                                </a>
                            </div>
                        </div>
                        <div class="red-text font-small" role="alert" id="errorPdf"></div>
                    </div>
                    <!-- FILE -->
                    <div class="col-12 col-lg-6 mt-3 mt-lg-0 m-auto">
                        <div class="form-group">
                            <div class="md-form">
                                  <textarea id="txtNote"
                                            class="md-textarea form-control"
                                            length="150"
                                            name="note"
                                            data-parsley-maxlength="150"></textarea>
                                <label for="txtNote">Nota</label>
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
