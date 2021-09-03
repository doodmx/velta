require('smartwizard');

import renderizeWYISYGEditor from '../../helpers/ckeditor';
import * as files from '../../helpers/image_preview';
import seoCardListeners from "../../helpers/seo.card.listeners";
import {saveCourse} from "./http";
import {CourseException} from "../../exceptions/CourseException";
import * as alerts from "../../helpers/alerts";
import addFileValidator from "../../helpers/file_validator";

$(function () {



    //----- INIT COMPONENTS -----
    $('#selectCourseType').prepend('<option value="" disabled selected>Seleccionar Categoría</option>');
    const ckeditorCourse = renderizeWYISYGEditor('txtDescription', 150);


    $("#smartwizard").smartWizard({
        theme: 'default',
        lang: {  // Language variables
            previous: 'Anterior',
            next: 'Siguiente'
        }
    }).on('leaveStep', function (e, anchorObject, stepNumber, stepDirection) {

        switch (stepNumber) {
            case 0:
                if (!$("#frmCourse").parsley().validate({group: 'general'}))
                    return false;
                break;
            case 1:
                if (!$("#frmCourse").parsley().validate({group: 'seo'}))
                    return false;
                break;

        }

    });

    addFileValidator();
    seoCardListeners('input[name="course[name]"]', 'textarea[name="course[excerpt]"]');


    $('#freeCourse').on('click', function () {

        const courseIsFree = $(this).is(':checked');
        $('#coursePrice').toggleClass('d-none');

        if (courseIsFree) {
            $('select[name="course[currency_id]"]')
                .val('')
                .trigger('change')
                .removeAttr('data-parsley-required');

            $('input[name="course[price]"]')
                .val('')
                .removeAttr('data-parsley-required');

        } else {
            $('select[name="course[currency_id]"],input[name="course[price]"]')
                .attr('data-parsley-required', true);
        }
    });
    //----- IMAGE PREVIEW -----
    $('#inputImgThumbnail').on('change', function () {
        files.readImageContent(this.files, '#imgThumbnail,#seoThumbnail');
    });

    $('#btnClearImage').on('click', function () {
        files.onRemoveImage('#inputImgThumbnail', '#imgThumbnail,#seoThumbnail');
    });


    //---- PARSLEY VALIDATION ON COMPONENTS

    $('select').on('change', function () {
        $(this).parsley().validate();
    });


    $('#btnSaveCourse').on('click', async function (e) {

        if ($('#frmCourse').parsley().isValid()) {

            try {

                await saveCourse();
                //Reset Form
                $('#frmCourse').trigger('reset');

                //Reset Course Type Select
                $('#selectCourseType').materialSelect({destroy: true});
                $('#selectCourseType').val("");
                $('#selectCourseType').materialSelect({});

                //Reset Course Description
                ckeditorCourse.setData("");

                //Reset Image selected
                $('#btnClearImage').click();

                alerts.successAlert('Cursos', '¡El curso se guardo correctamente!');

            } catch (e) {

                console.log(e);
                if (e instanceof CourseException) {

                    if (e.validationErrors !== '') {
                        alerts.errorAlert(e.name, e.validationErrors);
                    } else {
                        alerts.errorAlert(e.name, e.message);

                    }
                }
            }

        }
    });
});
