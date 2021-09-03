import tag from './tag';
import '../../helpers/axios';
import {TagException} from "../../exceptions/TagException";
import {serializeArrayToJson} from "../../helpers/json";
import {CourseException} from "../../exceptions/CourseException";


export async function save() {


    const serializedData = $('#tagForm').serializeArray();
    const jsonData = serializeArrayToJson(serializedData);
    const isCreating = tag.id === null;


    try {


        if (isCreating) {

            return await axios.post('/admin/tags', jsonData);

        } else {
            return await axios.patch('/admin/tags/' + tag.id, jsonData);

        }


    } catch (e) {

        const codeStatus = e.response.status;
        const tagException = new TagException('Hubo un error al guardar la etiqueta, intente más tarde.');

        if (codeStatus === 422) {
            tagException.setValidationErrors(e.response.data.errors.meta);
        }

        throw tagException;
    }


}


export async function show(id) {

    try {

        const {data} = await axios.get('/admin/tags/' + id);

        return data;

    } catch (e) {


        let message = e.response.data.message;
        throw new TagException(message);
    }
}


export async function restoreTag(id) {

    try {

        await axios.put(`/admin/tags/${id}/restore`);

    } catch (e) {

        throw new CourseException('Hubo un error al restaurar la etiqueta, intente más tarde.');
    }


}

export async function deleteTag(id) {

    try {

        await axios.delete(`/admin/tags/${id}`);

    } catch (e) {

        throw new CourseException('Hubo un error al eliminar la etiqueta, intente más tarde.');
    }


}


