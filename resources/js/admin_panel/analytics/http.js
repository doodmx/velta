import {Exception} from "../../exceptions/Exception";

require('../../helpers/axios');


export default async function getAnalyticsStats() {

    const from = $('#txtFrom').pickadate('picker').get('select', 'yyyy-mm-dd');
    const to = $('#txtTo').pickadate('picker').get('select', 'yyyy-mm-dd');


    try {

        const {data} = await axios.get(`/admin/analytics/stats?from=${from}&to=${to}`);

        return data;

    } catch (e) {

        const errors = e.response.data.errors;
        const analyticsException = new Exception();
        analyticsException.setName('Google Analytics');
        analyticsException.setMessage(errors.title + errors.detail);

        throw analyticsException;
    }
}
