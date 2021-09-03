import * as http from "./http";
import {CartException} from "../../exceptions/CartException";
import * as alerts from '../../helpers/alerts';
import * as stripe from './payment_gateways/stripe';
import messages from '../../lang/cart';

$(function () {

    stripe.createInstance();
    stripe.renderCardForm();
    stripe.showCardErrors();

    $("#btnCheckout").on("click", async function (e) {


        $("#btnCheckout").attr('disabled', true);

        try {

            const paymentIntent = await stripe.getIntent();
            const paymentMethodId = await stripe.confirmCard(paymentIntent.intent.client_secret);
            $('input[name=paymentToken]').val(paymentMethodId);


            await http.postPaymentCart();


            $("#btnCheckout").removeAttr('disabled');
            alerts.successAlert(messages.module[appLocale], messages.success_payment[appLocale]);

        } catch (e) {

            $("#btnCheckout").removeAttr('disabled');

            if (e instanceof CartException) {
                if (e.validationErrors !== '') {
                    alerts.errorAlert(e.name, e.validationErrors);
                } else {
                    alerts.errorAlert(e.name, e.message);

                }
            }
        }


    });
});


