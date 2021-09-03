import user from "../user";
import {verifyAccount} from "../http";
import {setUserData} from "../actions";
import {usersTable} from "../index/app";
import * as alerts from '../../../helpers/alerts';
import {setModalSettings} from "../index/actions";
import {UserException} from "../../../exceptions/UserException";

export function onView() {

    $(document).on('click', '.btn-account-verification', async function () {

        const userData = $(this).parent('.dropdown-menu');
        setUserData(userData);
        setModalSettings('.verification-modal');

    });


}


export function onSubmit() {

    $('#frmAccountVerification').on('submit', async function (e) {

        e.preventDefault();
        const formIsValid = $(this).parsley().isValid();


        if (formIsValid) {

            try {

                $('#frmAccountVerification input[name="whatsapp"]').val(user.itiPhone.getNumber());
                const {data} = await verifyAccount();
                usersTable.ajax.reload();

                $(".verification-modal").modal('hide');
                $("#frmAccountVerification").trigger('reset');
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
