import * as http from "./http";
import * as alerts from "../../helpers/alerts";
import {RegisterException} from "../../exceptions/RegisterException";


export async function registerLead() {
    let response;
    let registerFormData = new FormData(document.getElementById('leadForm'));

    try {
        response = await http.register(registerFormData);
        $('#leadForm').trigger('reset');

        const whatsappText = `
            ¡ Quiero ser Partner Velta !
            *Nombre*: ${response.data.user.profile.name} ${response.data.user.profile.lastname}
            *Teléfono*: ${response.data.user.profile.whatsapp}
            *Correo* : ${response.data.user.email}
        `;
        alerts.successAlert('Velta', response.data.message);
        if(!response.data.is_partner){
            window.open('https://wa.me/5215572293527?text=' + whatsappText, '_blank');
        }
    } catch (e) {
        console.log(e);
        if (e instanceof RegisterException) {
            if (e.validationErrors !== '') {
                alerts.errorAlert(e.name, e.validationErrors);
            } else {
                alerts.errorAlert(e.name, e.message);
            }
        }
    }
}
