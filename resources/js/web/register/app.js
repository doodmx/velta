require("parsleyjs");
require("parsleyjs/dist/i18n/es");

import {registerLead} from "./app.actions"

$(function () {
    //----- INIT COMPONENTS -----

    window.Parsley.setLocale(appLocale);

    $('#leadForm').parsley();
    const input = document.querySelector("#phone");
    let iti = window.intlTelInput(input, {
        initialCountry: 'MX',
        preferredCountries: ['us', 'gb', 'br', 'ru', 'cn', 'es', 'it'],
        autoPlaceholder: 'aggressive',
        separateDialCode: true,
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.6/js/utils.js"
    });

    $('#leadForm').on('submit', async function (e) {
        e.preventDefault();

        if ($(this).parsley().isValid()) {

            $('input[name=whatsapp]').val(iti.getNumber());
            registerLead();
        }
    });
});
