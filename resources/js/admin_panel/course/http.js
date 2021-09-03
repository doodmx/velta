import '../../helpers/axios';
import {CourseException} from "../../exceptions/CourseException";


export async function saveCourse() {


    try {


        const courseForm = document.getElementById('frmCourse');
        const courseData = new FormData(courseForm);


        await axios.post(courseForm.dataset.action, courseData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });


    } catch (e) {

        const codeStatus = e.response.status;
        const courseException = new CourseException('Hubo un error al guardar el curso, intente más tarde.');

        if (codeStatus === 422) {
            courseException.setValidationErrors(e.response.data.errors.meta);
        }

        throw courseException;
    }


}

export async function restoreCourse(id) {

    try {

        await axios.put(`/admin/courses/${id}/restore`);

    } catch (e) {

        throw new CourseException('Hubo un error al restaurar el curso, intente más tarde.');
    }


}

export async function deleteCourse(id) {

    try {

        await axios.delete(`/admin/courses/${id}`);

    } catch (e) {

        throw new CourseException('Hubo un error al eliminar el curso, intente más tarde.');
    }


}
