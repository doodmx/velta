<form id="frmSendPayment" action="" data-parsley-validate="true">


    <!-- Central Modal Small -->
    <div class="modal fade"
         id="paymentEmailModal"
         tabindex="-1"
         role="dialog"
         aria-labelledby="myModalLabel"
         aria-hidden="true">

        <!-- Change class .modal-sm to change the size of the modal -->
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">


            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h4 class="modal-title w-100 text-primary font-weight-bold" id="myModalLabel">
                        Envio de Pago por Correo
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">

                        <p class="text-lime-green">Recibo</p>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-file-pdf fa-2x d-inline-block mr-2"></i>
                            <div id="receiptName" class="d-inline-block">Ejemplo</div>
                        </div>

                        <!-- Subject -->
                        <div class="md-form form-group form-lg">
                            {{ Form::text('subject',
                                null, [
                                'class' => 'form-control form-control-lg',
                                'placeholder'=>'¿Porque envio este recibo?',
                                'data-parsley-required' => true
                            ]) }}
                            <label for="txtName" class="active">
                                Asunto
                            </label>
                        </div>
                        <!-- Subject -->

                        <!-- Email -->
                        <div class="md-form form-group form-lg">
                            {{ Form::text('email',
                                null, [
                                'class' => 'form-control form-control-lg',
                                'data-parsley-required' => true
                            ]) }}
                            <label for="txtName" class="active">
                                Destinatario
                            </label>
                        </div>
                        <!-- Subject -->


                        <!-- Copies -->
                        <div class="md-form form-group form-lg">
                            {{ Form::text('bcc',
                                null, [
                                'class' => 'form-control form-control-lg',
                                'placeholder'=>'Copias'

                            ]) }}
                            <label for="txtName" class="active">
                                CC:
                            </label>
                        </div>
                        <!-- Subject -->

                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-primary btn-rounded btn-sm" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-secondary btn-rounded  btn-sm">Enviar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Central Modal Small -->
</form>
