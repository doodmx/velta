import * as alerts from '../../helpers/alerts';
import * as http from './http';
import {CourseException} from "../../exceptions/CourseException";

$(function () {


    /*----- A CERTIFICATION QUIZ WAS STORED----- */
    const aQuizWereStored = $('#localData').data('quiz_stored') !== '';
    if (aQuizWereStored) {
        alerts.successAlert('Cursos', 'Cuestionario de certificación guardado correctamente');
    }


    /*----- DATATABLES -----*/
    $('#dataTableBuilder').on('preXhr.dt', function (e, settings, data) {
        data.course_type = $('#courseTypeSelect').val();
        data.course_status = $('#courseStatus').val();
    });

    $("#courseTypeSelect,#courseStatus").on("change", function () {
        $('#dataTableBuilder').DataTable().ajax.reload();
    });

    $(document).on('click', '.activateCourse', async function (e) {
        e.preventDefault();

        const id = $(this).data('id');
        const confirmRestoration = await alerts.confirmAlert('Cursos', '¿Está seguro(a) de reestablecer este curso?');

        if (confirmRestoration.value) {

            try {

                await http.restoreCourse(id);
                $('#dataTableBuilder').DataTable().ajax.reload();
                alerts.successAlert('Cursos', 'Curso restaurado correctamente');


            } catch (e) {

                if (e instanceof CourseException) {
                    alerts.errorAlert(e.name, e.message);
                }
            }
        }

    });


    $(document).on('click', '.deactivateCourse', async function (e) {
        e.preventDefault();

        const id = $(this).data('id');
        const confirmRemoval = await alerts.confirmAlert('Cursos', '¿Está seguro(a) de eliminar este curso?');

        if (confirmRemoval.value) {

            try {

                await http.deleteCourse(id);
                $('#dataTableBuilder').DataTable().ajax.reload();
                alerts.successAlert('Cursos', 'Curso eliminado correctamente');


            } catch (e) {

                if (e instanceof CourseException) {
                    alerts.errorAlert(e.name, e.message);
                }
            }


        }
    });


});
