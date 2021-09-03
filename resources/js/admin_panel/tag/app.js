import * as http from "./http";
import * as actions from './actions';
import * as alerts from "../../helpers/alerts";
import {TagException} from "../../exceptions/TagException";


$(document).ready(function () {

    $("#tagForm").parsley();


    const tagsTable = $('#dataTableBuilder').DataTable();
    tagsTable.on('preXhr.dt', function (e, settings, data) {
        data.tag_status = $('#tagStatus').val();
    });


    $("#tagStatus").on("change", function () {
        tagsTable.ajax.reload();
    });

    $(document).on("click", "#openTagModal", function () {

        actions.setData({id: null, tag: {tag: null}, deleted_at: null});
        actions.fillForm('Nueva Etiqueta');
        return false;
    });

    // On Edit Tag
    $(document).on("click", ".edit-tag", async function () {

        const tagId = $(this).data("id");

        try {

            const data = await http.show(tagId);
            actions.setData(data.tag);
            actions.fillForm('Editar Etiqueta');


        } catch (e) {
            if (e instanceof TagException) {
                alerts.errorAlert('Etiquetas', e.message);
            }
        }

        return false;
    });


    //On Save/Update
    $("#tagForm").on("submit", async function (e) {

        e.preventDefault();
        const formIsValid = $("#tagForm").parsley().isValid();


        if (formIsValid) {

            try {

                await http.save();
                tagsTable.ajax.reload();

                $("#tagModal").modal("hide");
                alerts.successAlert('Etiquetas', 'Etiqueta guardada correctamente');

            } catch (e) {

                console.log(e);
                if (e instanceof TagException) {

                    if (e.validationErrors !== '') {
                        alerts.errorAlert(e.name, e.validationErrors);
                    } else {
                        alerts.errorAlert(e.name, e.message);

                    }
                }

            }
        }


        return false;
    });


    $(document).on('click', '.activate-tag', async function (e) {
        e.preventDefault();

        const id = $(this).data('id');
        const confirmRestoration = await alerts.confirmAlert('Etiquetas', '¿Está seguro(a) de reestablecer esta etiqueta?');

        if (confirmRestoration.value) {

            try {

                await http.restoreTag(id);
                tagsTable.ajax.reload();
                alerts.successAlert('Etiquetas', 'Etiqueta restaurada correctamente');


            } catch (e) {

                if (e instanceof TagException) {
                    alerts.errorAlert(e.name, e.message);
                }
            }
        }

    });


    $(document).on('click', '.deactivate-tag', async function (e) {
        e.preventDefault();

        const id = $(this).data('id');
        const confirmRemoval = await alerts.confirmAlert('Etiquetas', '¿Está seguro(a) de eliminar esta etiqueta?');

        if (confirmRemoval.value) {

            try {

                await http.deleteTag(id);
                $('#dataTableBuilder').DataTable().ajax.reload();
                alerts.successAlert('Etiquetas', 'Etiqueta eliminada correctamente');


            } catch (e) {

                if (e instanceof TagException) {
                    alerts.errorAlert(e.name, e.message);
                }
            }


        }
    });

});
