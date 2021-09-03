import {TransactionException} from "../../../../exceptions/TransactionException";
import messages from "../../../../lang/profile";


export async function save() {
    try {

        const balance = (parseFloat(investment.profit) + parseFloat(investment.balance)) - parseFloat(investment.withdrawal);

        const transactionData = {
            investment_id : investment.id,
            amount        : $('#txtAmount').val(),
            balance       : balance,
            type          : $('#selectType').val(),
        };

        return await axios.post(`/admin/users/${investment.user_id}/investment/${investment.id}/transactions/`, transactionData);

    } catch (e) {
        const codeStatus = e.response.status;
        const transactionException = new TransactionException(messages.error_store[appLocale]);

        if (codeStatus === 422) {
            transactionException.setValidationErrors(e.response.data.errors.meta);
        }

        throw transactionException;
    }
}
