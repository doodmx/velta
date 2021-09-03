try {
    global.Popper = require('popper.js').default;
    global.$ = global.jQuery = require('jquery');

    require('bootstrap');
    require('block-ui');

    /*----- MDB SCRIPTS ----- */
    require('../../mdbpro/4.11.0/js/modules/dropdown/dropdown.min');
    require('../../mdbpro/4.11.0/js/modules/dropdown/dropdown-searchable.min');
    require('../../mdbpro/4.11.0/js/modules/accordion-extended.min');
    require('../../mdbpro/4.11.0/js/modules/animations-extended.min');
    require('../../mdbpro/4.11.0/js/modules/buttons.min');
    require('../../mdbpro/4.11.0/js/modules/cards.min');
    require('../../mdbpro/4.11.0/js/modules/file-input.min');
    require('../../mdbpro/4.11.0/js/modules/collapsible.min');
    require('../../mdbpro/4.11.0/js/modules/forms-free.min');
    require('../../mdbpro/4.11.0/js/modules/parallax.min');
    require('../../mdbpro/4.11.0/js/modules/scrolling-navbar.min');
    require('../../mdbpro/4.11.0/js/modules/sidenav.min');
    require('../../mdbpro/4.11.0/js/modules/smooth-scroll.min');
    require('../../mdbpro/4.11.0/js/modules/sticky.min');
    require('../../mdbpro/4.11.0/js/modules/wow.min');


    require('parsleyjs');
    require('parsleyjs/dist/i18n/es');


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
    console.log(e);

}
