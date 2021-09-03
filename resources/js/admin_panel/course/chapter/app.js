import {
    openModal,
    setFormChapterData,
    createOrUpdateChapter,
    deleteChapter,
    fillChapter,
    fillForm, appendChapterToContainer, updateCounter
} from "./app.actions";
import * as alerts from "../../../helpers/alerts";
import * as files from "../../../helpers/image_preview";
import addFileValidator from "../../../helpers/file_validator";
import * as http from './http';
import {ChapterException} from "../../../exceptions/ChapterException";

const courseId = $('#localData').data('course');
export const chapterForm = document.getElementById('frmAddChapter');
$(function () {

    addFileValidator();
    $('input[name="icon"]').on('change', function () {
        files.readImageContent(this.files, '#imgThumbnail');
    });

    $('#btnClearImage').on('click', function () {
        files.onRemoveImage('input[name=icon]', '#imgThumbnail');
    });


    $(document).on('click', '.btn-add-chapter', async function (e) {
        e.preventDefault();

        const chapterElement = $(this);
        fillForm({
            id: $(this).data('id'),
            parent_course_id: courseId
        }, chapterElement);
        openModal('create');

    });

    $(document).on('click', '.btn-edit-chapter', async function (e) {


        const chapterId = $(this).data('id');
        const chapterElement = $(this);


        try {

            const chapter = await http.showChapter(chapterId);
            fillForm(chapter.data.attributes, chapterElement);
            openModal('edit');

        } catch (e) {

            if (e instanceof ChapterException) {
                alerts.errorAlert(e.name, e.message);
            }
        }


    });

    $(document).on('click', '.btn-delete-chapter', async function (e) {
        e.preventDefault();

        const id = $(this).data('id');
        const chapterElement = $(this).data('chapter_element');
        const countNode = $(this).data('count_node');


        const confirmDelete = await alerts.confirmAlert('Capítulos', '¿Está seguro(a) de eliminar este capítulo?')


        if (confirmDelete.value) {

            try {

                await http.deleteChapter(id);

                $(chapterElement).remove();
                updateCounter(countNode, -1);

                alerts.successAlert('Capítulos', 'Capítulo eliminado correctamente');

            } catch (e) {

                if (e instanceof ChapterException) {
                    alerts.errorAlert(e.name, e.message);
                }
            }
        }


    });


    $('#frmAddChapter').on('submit', async function (e) {
        e.preventDefault();

        const reRenderChapter = $('#txtReRenderChapter').val();
        const chaptersContainer = $('#txtAppendChapterTo').val();
        const isEditMode = $('input[name=_method]').val() === 'PATCH';
        const countNode = $('#txtChapterId').val();

        console.log(countNode);

        if ($(this).parsley().isValid()) {

            try {

                const response = await http.saveChapter();

                if (isEditMode) {
                    $(reRenderChapter).html(response.view);
                } else {

                    $(chaptersContainer).append(response.view);
                    updateCounter(countNode, 1);

                }


                chapterForm.reset();
                $('#imgThumbnail').attr('src','');
                $("#chapterModal").modal('hide');
                alerts.successAlert('Capítulo', 'Capítulo guardado correctamente');

            } catch (e) {

                if (e instanceof ChapterException) {
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
