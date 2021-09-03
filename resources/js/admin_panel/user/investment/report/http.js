import {ReportException} from "../../../../exceptions/ReportException";
import messages from "../../../../lang/profile";
import user from "../../user";


export async function save() {
    try {
        const config = {
            headers: {
                'content-type': 'multipart/form-data',
            }
        };

        const reportForm = document.getElementById('frmReport');
        let reportFormData = new FormData(reportForm);
        reportFormData.append('user_id', investment.user_id);
        reportFormData.append('investment_id', investment.id);
        return await axios.post(`/admin/users/${investment.user_id}/investment/${investment.id}/reports`, reportFormData, config);
    } catch (e) {
        const codeStatus = e.response.status;
        const reportException = new ReportException(messages.error_store[appLocale]);

        if (codeStatus === 422) {
            reportException.setValidationErrors(e.response.data.errors.meta);
        }

        throw reportException;
    }
}

export async function destroy(reportId) {
    try {
        return await axios.delete(`/admin/users/${investment.user_id}/investment/${investment.id}/reports/${reportId}`);
    } catch (e) {
        const codeStatus = e.response.status;
        const reportException = new ReportException(messages.error_store[appLocale]);

        if (codeStatus === 422) {
            reportException.setValidationErrors(e.response.data.errors.meta);
        }

        throw reportException;
    }
}
