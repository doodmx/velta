import * as http from "./http";
import * as actions from './actions';
import * as alerts from "../../helpers/alerts";
import {CategoryException} from "../../exceptions/CategoryException";


$(document).ready(function () {

    $("#categoryForm").parsley();

    const categoriesTable = $('#dataTableBuilder').DataTable();
    categoriesTable.on('preXhr.dt', function (e, settings, data) {
        data.category_status = $('#categoryStatus').val();
    });


    $("#categoryStatus").on("change", function () {
        categoriesTable.ajax.reload();
    });

    $(document).on("click", "#openCategoryModal", function () {

        actions.setData({id: null, category: {category: null}, deleted_at: null});
        actions.fillForm('Nueva Categoría');
        return false;
    });

    $(document).on("click", ".edit-category", async function () {

        const categoryId = $(this).data("id");

        try {

            const data = await http.show(categoryId);
            actions.setData(data.category);
            actions.fillForm('Editar Categoría');


        } catch (e) {
            if (e instanceof CategoryException) {
                alerts.errorAlert(e.name, e.message);
            }
        }

        return false;
    });


    //On Save/Update
    $("#categoryForm").on("submit", async function (e) {

        e.preventDefault();
        const formIsValid = $("#categoryForm").parsley().isValid();


        if (formIsValid) {

            try {

                await http.save();
                categoriesTable.ajax.reload();

                $("#categoryModal").modal("hide");
                alerts.successAlert('Etiquetas', 'Categoría guardada correctamente');

            } catch (e) {

                console.log(e);
                if (e instanceof CategoryException) {

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


    $(document).on('click', '.activate-category', async function (e) {
        e.preventDefault();

        const id = $(this).data('id');
        const confirmRestoration = await alerts.confirmAlert('Categorías', '¿Está seguro(a) de reestablecer esta categoría?');

        if (confirmRestoration.value) {

            try {

                await http.restoreCategory(id);
                categoriesTable.ajax.reload();
                alerts.successAlert('Categorías', 'Categoría restaurada correctamente');


            } catch (e) {

                if (e instanceof CategoryException) {
                    alerts.errorAlert(e.name, e.message);
                }
            }
        }

    });


    $(document).on('click', '.deactivate-category', async function (e) {
        e.preventDefault();

        const id = $(this).data('id');
        const confirmRemoval = await alerts.confirmAlert('Categorías', '¿Está seguro(a) de eliminar esta categoría?');

        if (confirmRemoval.value) {

            try {

                await http.deleteCategory(id);
                categoriesTable.ajax.reload();
                alerts.successAlert('Categorías', 'Categoría eliminada correctamente');


            } catch (e) {

                if (e instanceof CategoryException) {
                    alerts.errorAlert(e.name, e.message);
                }
            }


        }
    });

});
