import '../../helpers/axios';
import {serializeArrayToJson} from "../../helpers/json";
import {PaymentException} from "../../exceptions/PaymentException";

export async function sendToEmail() {

    const emailForm = $('#frmSendPayment');
    try {
        const formData = serializeArrayToJson(emailForm.serializeArray());
        const {data} = await axios.post(emailForm.attr('action'), formData);

        return {data};

    } catch (e) {

        const codeStatus = e.response.status;
        const paymentException = new PaymentException('Hubo un error al enviar el pago, intente nuevamente.');

        if (codeStatus === 422) {
            paymentException.setValidationErrors(e.response.data.errors.meta);
        }

        throw paymentException;
    }
}
