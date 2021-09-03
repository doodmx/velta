require('./bootstrap');
require('./settings/sidebar')
require('./settings/dark_mode')
require('../helpers/sticky_header');

$(function () {

    $('[data-toggle="tooltip"]').tooltip();


    if ($('.mdb-select').length) {
        $('.mdb-select').materialSelect();
    }


    if ($('.datepicker').length) {

        $('.datepicker').pickadate({
            monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre',
                'Noviembre', 'Diciembre'],
            monthsShort: ['Ene', 'Feb', 'Marz', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            weekdaysShort: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
            showMonthsShort: true,
            today: 'Hoy',
            clear: 'Limpiar',
            close: 'Cerrar',
            formatSubmit: 'yyyy-mm-dd'
        });
    }


    if ($('.timepicker').length) {

        $('.timepicker').pickatime({
            twelvehour: true,
            donetext: 'Aceptar',
            cleartext: 'Cancelar'
        });
    }


    $('.modal').on('shown.bs.modal', function (e) {
        $('.sticky-header-top').hide();
    });

    $('.modal').on('hidden.bs.modal', function (e) {
        $('.sticky-header-top').show();
    });


});

