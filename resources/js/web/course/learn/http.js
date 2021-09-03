import '../../../helpers/axios';
import {CourseException} from "../../../exceptions/CourseException";


const enrollId = $('#localData').data('enroll');

export async function markChapterAsDone(chapterId) {

    try {

        const response = await axios.put(`/enrolls/${enrollId}/chapters/${chapterId}`);

        return response.data.enroll;

    } catch (e) {
        throw new CourseException('Hubo un error al marcar el capítulo como terminado, intente más tarde');
    }
}

export async function markChapterAsPendant(chapterId) {

    try {

        const response = await axios.delete(`/enrolls/${enrollId}/chapters/${chapterId}`);

        return response.data.enroll;


    } catch (e) {

        throw new CourseException('Hubo un error al marcar el capítulo como pendiente, intente más tarde');
    }
}
