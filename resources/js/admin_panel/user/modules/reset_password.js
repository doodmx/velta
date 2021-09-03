import {resetPassword} from "../http";
import {setUserData} from "../actions";
import {usersTable} from "../index/app";
import * as alerts from '../../../helpers/alerts';
import {setModalSettings} from "../index/actions";
import {UserException} from "../../../exceptions/UserException";

export function onView() {

    $(document).on('click', '.btn-reset-password', async function () {

        const userData = $(this).parent('.dropdown-menu');
        setUserData(userData);
        setModalSettings('.reset-password-modal');

    });


}


export function onSubmit() {

    $('#frmResetPassword').on('submit', async function (e) {

        e.preventDefault();
        const formIsValid = $(this).parsley().isValid();


        if (formIsValid) {

            try {


                const {data} = await resetPassword();
                usersTable.ajax.reload();

                $(".reset-password-modal").modal('hide');
                $("#frmResetPassword").trigger('reset');
                alerts.successAlert('Usuarios', data.message);

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
