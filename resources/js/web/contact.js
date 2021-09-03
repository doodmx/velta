import * as appHttp from './http';
import {errorAlert, successAlert} from "../helpers/alerts";
import {LeadException} from "../exceptions/LeadException";


$(function () {

    window.Parsley.setLocale('es');

    $('#contactForm').parsley();
    $('#appointmentForm').parsley();


    const itis = [];
    const phones = document.getElementsByClassName("contact-phone");


    phones.forEach(function (phone) {

        const itiComponent = window.intlTelInput(phone, {
            initialCountry: 'MX',
            preferredCountries: ['us', 'gb', 'br', 'ru', 'cn', 'es', 'it'],
            autoPlaceholder: 'aggressive',
            separateDialCode: true,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.6/js/utils.js"
        });

        itis.push(itiComponent);
    });


    $('#contactForm').on('submit', async function (e) {

        e.preventDefault();

        const isValid = $(this).parsley().isValid();


        if (isValid) {


            try {

                $('#contact-phone').val(itis[0].getNumber());
                const response = await appHttp.postLeadEmail();
                gtag('event', 'contacto', {
                    'value': 1
                });
                successAlert('Velta', response.message);

            } catch (e) {


                if (e instanceof LeadException) {

                    if (e.validationErrors !== '') {
                        errorAlert(e.name, e.validationErrors);
                    } else {
                        errorAlert(e.name, e.message);

                    }
                }
            }

        }


    });

    $('#appointmentForm').on('submit', async function (e) {
        e.preventDefault();


        try {


            const isValid = $(this).parsley().isValid();
            if (isValid) {
                $('#appointment-phone').val(itis[1].getNumber());
                const response = await appHttp.postAppointmentEmail();
                gtag('event', 'contacto', {
                    'value': 1
                });
                successAlert('Velta', response.message);
            }


        } catch (e) {

            console.log(e);

            if (e instanceof LeadException) {

                if (e.validationErrors !== '') {
                    errorAlert(e.name, e.validationErrors);
                } else {
                    errorAlert(e.name, e.message);

                }
            }
        }

    });


});

