import user from './user';
import '../../helpers/axios';
import {UserException} from "../../exceptions/UserException";
import messages from '../../lang/profile';


export async function resetPassword() {
    try {

        const userForm = document.getElementById('frmResetPassword');
        let userFormData = new FormData(userForm);

        return await axios.post(`/admin/users/${user.id}/credentials`, userFormData);


    } catch (e) {
        const codeStatus = e.response.status;
        const userException = new UserException('Hubo un error al cambiar las credenciales del usuario, intente más tarde.');

        if (codeStatus === 422) {
            userException.setValidationErrors(e.response.data.errors.meta);
        }

        throw userException;
    }

}


export async function updateProfile() {
    try {

        const profileForm = document.getElementById('frmProfile');
        let profileFormData = new FormData(profileForm);

        return await axios.post(`/admin/users/${user.id}`, profileFormData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });


    } catch (e) {


        const codeStatus = e.response.status;
        const userException = new UserException(messages.error_store[appLocale]);

        if (codeStatus === 422) {
            userException.setValidationErrors(e.response.data.errors.meta);
        }

        throw userException;
    }
}


export async function updateRole() {
    try {

        const roleForm = document.getElementById('frmRole');
        let roleFormData = new FormData(roleForm);

        return await axios.post(`/admin/users/${user.id}/role`, roleFormData );


    } catch (e) {

        const codeStatus = e.response.status;
        const userException = new UserException('Hubo un error al cambiar el rol de usuario, intente más tarde');

        if (codeStatus === 422) {
            userException.setValidationErrors(e.response.data.errors.meta);
        }

        throw userException;
    }
}



export async function verifyAccount() {
    try {

        const userForm = document.getElementById('frmAccountVerification');
        let userFormData = new FormData(userForm);

        return await axios.post(`/admin/users/${user.id}/verifyAccount`, userFormData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });


    } catch (e) {

        const codeStatus = e.response.status;
        const userException = new UserException('Hubo un error al enviar las credenciales, intente más tarde.');

        if (codeStatus === 422) {
            userException.setValidationErrors(e.response.data.errors.meta);
        }

        throw userException;
    }
}


export async function deleteUser(id) {

    const userRole = $('#localData').data('role');
    let route = `/admin/users/${id}`;

    if (userRole === 'Partner') {
        route = `/partner/investments/${id}`;
    }
    try {

        return await axios.delete(route);

    } catch (e) {
        throw new UserException(messages.error_delete[appLocale]);
    }
}
