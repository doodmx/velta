import {CartException} from "../../exceptions/CartException";
import messages from '../../lang/cart';


export async function postPaymentCart() {

    try {


        const cartForm = document.getElementById('cartForm');
        const cartData = new FormData(cartForm);

        await axios.post('/payments/charge', cartData);

        console.log('payment done');

    } catch (error) {

        const codeStatus = error.response.status;
        const cartException = new CartException(messages.error_payment[appLocale]);
        cartException.setName(messages.module[appLocale]);

        if (error.response.data.message !== undefined) {
            cartException.setMessage(error.response.data.message);
        }

        if (codeStatus === 422) {
            cartException.setValidationErrors(error.response.data.errors.meta);
        }

        throw cartException;

    }
}
