import * as alerts from '../../helpers/alerts';
import * as http from './http';
import {CourseTypeException} from "../../exceptions/CourseTypeException";

$(function () {


    $('#dataTableBuilder').on('preXhr.dt', function (e, settings, data) {
        data.course_type_status = $('#courseTypeStatus').val();
    });

    $("#courseTypeStatus").on("change", function () {
        $('#dataTableBuilder').DataTable().ajax.reload();
    });

    $(document).on('click', '.activateCourseType', async function () {

        const id = $(this).data('id');
        const confirmRestoration = await alerts.confirmAlert('Categorías de Cursos', '¿Está seguro(a) de reestablecer esta categoría?');

        if (confirmRestoration.value) {

            try {

                await http.restoreCourseType(id);
                $('#dataTableBuilder').DataTable().ajax.reload();
                alerts.successAlert('Categorías de Cursos', 'Categoría restaurada correctamente');


            } catch (e) {

                if (e instanceof CourseTypeException) {
                    alerts.errorAlert(e.name, e.message);
                }
            }
        }

    });


    $(document).on('click', '.deactivateCourseType', async function () {

        const id = $(this).data('id');
        const confirmRemoval = await alerts.confirmAlert('Categorías de Cursos', '¿Está seguro(a) de eliminar esta categoría ?');

        if (confirmRemoval.value) {

            try {

                await http.deleteCourseType(id);
                $('#dataTableBuilder').DataTable().ajax.reload();
                alerts.successAlert('Categorías de Cursos', 'Categoría eliminada correctamente');


            } catch (e) {

                if (e instanceof CourseTypeException) {
                    alerts.errorAlert(e.name, e.message);
                }
            }


        }
    });


});
