import '../../helpers/axios';
import {RoleException} from "../../exceptions/RoleException";


export async function saveRole() {


    try {


        const roleForm = document.getElementById('frmRole');
        const roleData = new FormData(roleForm);


        return await axios.post(roleForm.dataset.action, roleData);


    } catch (e) {

        const codeStatus = e.response.status;
        const roleException = new RoleException('Hubo un error al guardar el rol, intente más tarde.');

        if (codeStatus === 422) {
            roleException.setValidationErrors(e.response.data.errors.meta);
        }

        throw roleException;
    }


}

export async function restoreRole(id) {

    try {

        await axios.put(`/admin/roles/${id}/restore`);

    } catch (e) {

        throw new RoleException('Hubo un error al restaurar el rol, intente más tarde.');
    }


}

export async function deleteRole(id) {

    try {

        await axios.delete(`/admin/roles/${id}`);

    } catch (e) {

        throw new RoleException('Hubo un error al eliminar el rol, intente más tarde.');
    }


}
