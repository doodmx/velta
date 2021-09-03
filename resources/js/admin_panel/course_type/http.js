import '../../helpers/axios';
import {CourseTypeException} from "../../exceptions/CourseTypeException";
import {isEditMode, courseTypeId, courseTypeForm} from './app';


export async function saveCourseType() {

    let api = `/admin/course_types`;
    const isEditMode = !isNaN(parseInt(courseTypeId));

    if (isEditMode) {
        api = api + '/' + courseTypeId;
    }

    try {

        const courseTypeData = new FormData(courseTypeForm);

        await axios.post(api, courseTypeData, {
            headers: {
                'Content-Type': 'multipart/form-data',
            }
        });


    } catch (e) {

        const codeStatus = e.response.status;
        const courseTypeException = new CourseTypeException('Hubo un error al guardar la categoría, intente más tarde.');

        if (codeStatus === 422) {
            courseTypeException.setValidationErrors(e.response.data.errors.meta);
        }

        throw courseTypeException;

    }


}

export async function restoreCourseType(id) {

    try {

        await axios.put(`/admin/course_types/${id}/restore`);

    } catch (e) {

        throw new CourseTypeException('Hubo un error al restaurar la categoría, intente más tarde.');
    }


}

export async function deleteCourseType(id) {

    try {

        await axios.delete(`/admin/course_types/${id}`);

    } catch (e) {

        throw new CourseTypeException('Hubo un error al eliminar la categoría, intente más tarde.');
    }


}
