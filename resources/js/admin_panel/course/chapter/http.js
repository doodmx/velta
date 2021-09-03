import '../../../helpers/axios';
import {ChapterException} from "../../../exceptions/ChapterException";
import {chapterForm} from "./app";


const courseId = $('#localData').data('course');


export async function showChapter(chapterId) {

    try {

        const {data} = await axios.get(`/admin/courses/${courseId}/chapters/${chapterId}`);
        return data;

    } catch (e) {


        throw new ChapterException('No se pudo encontrar el capítulo solicitado');
    }
}


export async function saveChapter() {

    let api = `/admin/courses/${courseId}/chapters`;
    const chapterId = $('#txtChapterId').val();
    const isEditMode = $('input[name=_method]').val() === 'PATCH';

    if (isEditMode) {
        api = api + '/' + chapterId;
    }

    try {

        const chapterData = new FormData(chapterForm);

        const {data} = await axios.post(api, chapterData, {
            headers: {
                'Content-Type': 'multipart/form-data',
            }
        });

        return data;


    } catch (e) {

        const codeStatus = e.response.status;
        const chapterException = new ChapterException('Hubo un error al guardar el capítulo, intente más tarde.');

        if (codeStatus === 422) {
            chapterException.setValidationErrors(e.response.data.errors.meta);
        }

        throw chapterException;

    }


}

export async function deleteChapter(chapterId) {
    try {
        return await axios.delete(`/admin/courses/${courseId}/chapters/${chapterId}`);
    } catch (e) {
        throw new CourseException('Hubo un error al eliminar el capítulo, intente más tarde.');
    }
}
