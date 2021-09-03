import category from './category';
import '../../helpers/axios';
import {serializeArrayToJson} from "../../helpers/json";
import {CategoryException} from "../../exceptions/CategoryException";


export async function save() {


    const serializedData = $('#categoryForm').serializeArray();
    const jsonData = serializeArrayToJson(serializedData);
    const isCreating = category.id === null;


    try {


        if (isCreating) {

            return await axios.post('/admin/categories', jsonData);

        } else {
            return await axios.patch('/admin/categories/' + category.id, jsonData);

        }


    } catch (e) {

        const codeStatus = e.response.status;
        const categoryException = new CategoryException('Hubo un error al guardar la categoría, intente más tarde.');

        if (codeStatus === 422) {
            categoryException.setValidationErrors(e.response.data.errors.meta);
        }

        throw categoryException;
    }


}


export async function show(id) {

    try {

        const {data} = await axios.get('/admin/categories/' + id);

        return data;

    } catch (e) {


        let message = e.response.data.message;
        throw new TagException(message);
    }
}


export async function restoreCategory(id) {

    try {

        await axios.put(`/admin/categories/${id}/restore`);

    } catch (e) {

        throw new CourseException('Hubo un error al restaurar la categoría, intente más tarde.');
    }


}

export async function deleteCategory(id) {

    try {

        await axios.delete(`/admin/categories/${id}`);

    } catch (e) {

        throw new CourseException('Hubo un error al eliminar la categoría, intente más tarde.');
    }


}


