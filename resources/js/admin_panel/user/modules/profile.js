import user from '../user';
import {setUserData} from "../actions";
import {usersTable} from "../index/app";
import {updateProfile, updateRole, deleteUser} from "../http";
import * as alerts from '../../../helpers/alerts';
import {setModalSettings} from "../index/actions";
import {UserException} from "../../../exceptions/UserException";
import messages from '../../../lang/profile';

export function onView() {

    $(document).on('click', '.btn-view-information', function () {

        const userData = $(this).parent('.dropdown-menu');

        setUserData(userData);
        setModalSettings('.profile-modal');

    });


}

export function onViewRole() {

    $(document).on('click', '.btn-view-role', function () {

        const userData = $(this).parent('.dropdown-menu');


        setUserData(userData);

        $('#selectChangeRole').val(user.role).trigger('change');
        $('#modalChangeRol').modal('show');

    });


}

export function onDelete() {

    $(document).on('click', '.delete-user', async function () {

        const userData = $(this).parents('.dropdown-menu')
        const willDeleteUser = await alerts.confirmAlert(
            'Usuarios',
            messages.delete_request[appLocale]
        );

        if (willDeleteUser.value) {

            try {

                await deleteUser(userData.data('id'));
                usersTable.ajax.reload();
                alerts.successAlert(messages.module[appLocale], messages.success_delete[appLocale]);


            } catch (e) {

                if (e instanceof UserException) {
                    alerts.errorAlert(e.name, e.message);
                }
            }

        }

    });

}


export function onSubmit() {

    $('#frmProfile').on('submit', async function (e) {

        e.preventDefault();
        const formIsValid = $(this).parsley().isValid();


        if (formIsValid) {


            try {

                $('#frmProfile input[name="whatsapp"]').val(user.itiPhone.getNumber());
                const {data} = await updateProfile();


                if (usersTable !== null) {
                    usersTable.ajax.reload();
                }

                $(".profile-modal").modal('hide');
                $("#frmProfile").trigger('reset');
                alerts.successAlert(messages.module[appLocale], messages.success_store[appLocale]);

            } catch (e) {



                if (e instanceof UserException) {
                    if (e.validationErrors !== '') {
                        alerts.errorAlert(e.name, e.validationErrors);
                    } else {
                        alerts.errorAlert(e.name, e.message);
                    }
                }

            }

        }
    });
}


export function onSubmitRole() {

    $('#frmRole').on('submit', async function (e) {

        e.preventDefault();

        try {

            await updateRole();
            usersTable.ajax.reload();


            $("#modalChangeRol").modal('hide');

            alerts.successAlert('Usuarios', 'El rol del usuario se actualizó correctamente');

        } catch (e) {


            if (e instanceof UserException) {
                if (e.validationErrors !== '') {
                    alerts.errorAlert(e.name, e.validationErrors);
                } else {
                    alerts.errorAlert(e.name, e.message);
                }
            }

        }


    });
}
