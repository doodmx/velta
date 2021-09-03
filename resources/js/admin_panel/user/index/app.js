import * as verify from '../modules/verify';
import {setDocsFileNames} from "../actions";
import * as profile from '../modules/profile';
import * as resetPassword from '../modules/reset_password';
import {destroyIntlInput, renderIntlInput} from "./actions";
import addFileValidator from "../../../helpers/file_validator";

export let usersTable = null;

$(function () {

    usersTable = $('#dataTableBuilder').DataTable();
    usersTable.on('preXhr.dt', function (e, settings, data) {
        data.role = $('#filterRole').val();
        data.partner_id = $('#filterPartner').val();
        data.membership = $('#filterMembership').val();
    });


    window.Parsley.setLocale(window.appLocale);
    addFileValidator();


    renderIntlInput('.profile-modal', 'txtProfileWhatsapp');
    destroyIntlInput('.profile-modal');

    renderIntlInput('.verification-modal', 'txtVerificationWhatsapp');
    destroyIntlInput('.verification-modal');

    setDocsFileNames();


    $("#filterRole,#filterPartner,#filterMembership").on("change", function () {
        usersTable.ajax.reload();
    });


    $('#filterRole')
        .prepend('<option value=""selected>Ver Todos</option>')
        .append('<option value="pending">Pendientes de Validar</option>');


    profile.onSubmit();
    profile.onView();
    profile.onViewRole();
    profile.onSubmitRole();
    profile.onDelete();

    verify.onSubmit();
    verify.onView();


    resetPassword.onSubmit();
    resetPassword.onView();

});

