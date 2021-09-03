require('bootstrap-tagsinput');

import {sendToEmail} from "./http";
import {successAlert, errorAlert} from "../../helpers/alerts";
import {PaymentException} from "../../exceptions/PaymentException";

$(function () {

    const emailForm = $('#frmSendPayment');
    const sendModal = $('#paymentEmailModal');


    /*----- DATATABLES -----*/
    $('input[name="bcc"]').tagsinput({
       tagClass:'bg-primary p-1 rounded'
    });

    $('#dataTableBuilder').on('preXhr.dt', function (e, settings, data) {
        data.currency_id = $('#currencySelect').val();
        data.status = $('#paymentStatus').val();
    });

    $("#currencySelect,#paymentStatus").on("change", function () {
        $('#dataTableBuilder').DataTable().ajax.reload();
    });


    /*----- SEND RECEIPT -----*/
    $(document).on('click', '.send-receipt', function () {

        const payment = $(this);

        $('#receiptName').text(payment.data('receipt'));
        $('input[name=email]').val(payment.data('email')).trigger('change');

        emailForm.attr('action', '/admin/payments/' + payment.data('id') + '/send');


        sendModal.modal('show');
    });


    $('#frmSendPayment').on('submit', async function (e) {
        e.preventDefault();

        try {


            await sendToEmail();
            successAlert('Pagos', 'El pago se envió correctamente');
            document.getElementById("frmSendPayment").reset();
            sendModal.modal('hide');

        } catch (e) {

            if (e instanceof PaymentException) {

                if (e.validationErrors !== '') {
                    errorAlert(e.name, e.validationErrors);
                } else {
                    errorAlert(e.name, e.message);
                }
            }
        }
    })

});
