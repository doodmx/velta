import * as alerts from "../../helpers/alerts";
import {RoleException} from "../../exceptions/RoleException";
import {saveRole} from "./http";

$(function () {



    //----- INIT COMPONENTS -----
    $('#frmRole').parsley();

    //---- PARSLEY VALIDATION ON COMPONENTS



    $('#btnSaveRole').on('click', async function (e) {
        if ($('#frmRole').parsley().validate()) {

            try {

                await saveRole();

                $('#frmRole').resetForm();
                alerts.successAlert('Roles', '¡El rol se guardo correctamente!');

            } catch (e) {

                if (e instanceof RoleException) {

                    if (e.validationErrors !== '') {
                        alerts.errorAlert(e.name, e.validationErrors);
                    } else {
                        alerts.errorAlert(e.name, e.message);

                    }
                }
            }

        }
    });
});
