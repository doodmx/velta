import {saveCourseType} from "./http";
import initComponents from "./init.components";
import * as files from '../../helpers/image_preview';
import {successAlert, errorAlert} from "../../helpers/alerts";
import seoCardListeners from "../../helpers/seo.card.listeners";
import {CourseTypeException} from "../../exceptions/CourseTypeException";


export const courseTypeForm = document.getElementById('frmCourseType');
export const courseTypeId = courseTypeForm? courseTypeForm.dataset.id : null;
export const isEditMode = !isNaN(parseInt(courseTypeId));

$(function () {

    initComponents();
    seoCardListeners('input[name="course_type[name]"]', 'textarea[name="course_type[description]"]');

    //----- IMAGE PREVIEW -----
    $('#inputImgThumbnail').on('change', function () {
        files.readImageContent(this.files, '#imgThumbnail,#seoThumbnail');
    });

    $('#btnClearImage').on('click', function () {
        files.onRemoveImage('#inputImgThumbnail', '#imgThumbnail,#seoThumbnail');
    });


    $('#btnSaveCourseType').on('click', async function () {


        try {

            const courseTypeFormIsValid = $('#frmCourseType').parsley().validate();

            if (courseTypeFormIsValid) {
                await saveCourseType();

                if (!isEditMode) {
                    courseTypeForm.reset();
                    $('#btnClearImage').click();
                }

                successAlert('Categorías de Curso', 'Categoría guardada correctamente');
            }


        } catch (e) {

            console.log(e);
            if (e instanceof CourseTypeException) {

                if (e.validationErrors !== '') {
                    errorAlert(e.name, e.validationErrors);
                } else {
                    errorAlert(e.name, e.message);

                }
            }

        }

    });


})
;
