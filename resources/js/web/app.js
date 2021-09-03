import {confirmAlert} from "../helpers/alerts";
import messages from '../lang/cart';

require('./bootstrap');

$(function () {

    $('.btn-empty-cart').on('click', async function (e) {

        e.preventDefault();

        const confirmEmptyCart = await confirmAlert(messages.module[appLocale], messages.empty_request[appLocale]);

        if (confirmEmptyCart.value) {
            $('.frm-empty-cart').submit();
        }

    });

    $('.btn-delete-cart-item').on('click', async function () {

        const confirmDelete = await confirmAlert(messages.module[appLocale], messages.delete_request[appLocale]);

        if (confirmDelete.value) {
            $('.frm-delete-cart-item').submit();
        }
    });

    $('[data-whatsapp]').on('click', function () {

        gtag('event', 'whatsapp', {
            'value': 1
        });
        window.open('https://wa.me/5215572293527?text=Buen%20dia%20quiero%20informes%20para%20iniciar%20en%20Velta');
        
    });

    $('[data-calling]').on('click', function () {

        gtag('event', 'llamada', {
            'value': 1
        });
        // window.open('tel:+5214422814509');
        window.open('tel:+5215572293527');
    });
});
