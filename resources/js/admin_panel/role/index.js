import * as alerts from '../../helpers/alerts';
import * as http from './http';
import {RoleException} from "../../exceptions/RoleException";

$(function () {


    $('#dataTableBuilder').on('preXhr.dt', function (e, settings, data) {
        data.role_status = $('#roleStatus').val();
    });

    $("#roleStatus").on("change", function () {
        $('#dataTableBuilder').DataTable().ajax.reload();
    });

    $(document).on('click', '.activateRole', async function (e) {
        e.preventDefault();

        const id = $(this).data('id');
        const confirmRestoration = await alerts.confirmAlert('Roles', '¿Está seguro(a) de reestablecer este rol?');

        if (confirmRestoration.value) {

            try {

                await http.restoreRole(id);
                $('#dataTableBuilder').DataTable().ajax.reload();
                alerts.successAlert('Roles', 'Rol restaurado correctamente');


            } catch (e) {

                if (e instanceof RoleException) {
                    alerts.errorAlert(e.name, e.message);
                }
            }
        }

    });


    $(document).on('click', '.deactivateRole', async function (e) {
        e.preventDefault();

        const id = $(this).data('id');
        const confirmRemoval = await alerts.confirmAlert('Roles', '¿Está seguro(a) de eliminar este rol?');

        if (confirmRemoval.value) {

            try {

                await http.deleteRole(id);
                $('#dataTableBuilder').DataTable().ajax.reload();
                alerts.successAlert('Roles', 'Rol eliminado correctamente');


            } catch (e) {

                if (e instanceof RoleException) {
                    alerts.errorAlert(e.name, e.message);
                }
            }


        }
    });


});
