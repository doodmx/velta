try {

    global.Popper = require('popper.js').default;
    global.$ = global.jQuery = require('jquery');

    require('bootstrap');
    require('block-ui');

    /*----- MDB SCRIPTS ----- */
    require('../../mdbpro/4.11.0/js/mdb.min');
    require('parsleyjs');
    require('parsleyjs/dist/i18n/es');


    require('datatables.net');
    require('datatables.net-bs4');
    require('datatables.net-responsive-bs4');
    require('datatables.net-buttons/js/buttons.html5.js');
    require('datatables.net-buttons/js/buttons.print.js');
    require('../../../vendor/yajra/laravel-datatables-buttons/src/resources/assets/buttons.server-side');



    global.app = $("#app");
    global.appLocale = $('#app').data('locale');


    global.intlTelInput = require('intl-tel-input');
    global.Swal = require('sweetalert2');

    global.axios = require('axios');
    global.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


    global.colors = {
        'primary': '#FE692E',
        'secondary': '#24272C',
        'secondary_two': '#64513d',
        'secondary-three': '#64513d',
        'tertiary': '#FFAD8D',
        'tertiary-two': '#37FFC2',
        'tertiary-three': '#10B683'
    };

} catch (e) {
    console.log('ERROR DE IMPORTACION', e);
}
