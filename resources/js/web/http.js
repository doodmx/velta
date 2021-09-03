import '../helpers/axios';
import {serializeArrayToJson} from "../helpers/json";
import {LeadException} from "../exceptions/LeadException";

export async function postLeadEmail() {

    const url = $('#contactForm').attr('action');
    const leadData = serializeArrayToJson($('#contactForm').serializeArray());

    try {
        const {data} = await axios.post(url, leadData);

        return data;

    } catch (e) {

        console.log(e);
        const codeStatus = e.response.status;
        const leadException = new LeadException(e.response.data.message);

        if (codeStatus === 422) {
            leadException.setValidationErrors(e.response.data.errors.meta);
        }

        throw leadException;
    }
}


export async function postAppointmentEmail() {

    const url = $('#appointmentForm').attr('action');
    const appointmentData = serializeArrayToJson($('#appointmentForm').serializeArray());

    try {
        const {data} = await axios.post(url, appointmentData);

        return data;

    } catch (e) {

        console.log(e);
        const codeStatus = e.response.status;
        const leadException = new LeadException(e.response.data.message);

        if (codeStatus === 422) {
            leadException.setValidationErrors(e.response.data.errors.meta);
        }

        throw leadException;
    }
}
