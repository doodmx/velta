import '../../../helpers/axios';
import {CartException} from "../../../exceptions/CartException";
import messages from '../../../lang/cart';
import esErrors from './errors/stripe/es';
import enErrors from './errors/stripe/en';

let stripe = null, cardElements = null;


export function createInstance() {

    stripe = Stripe($('#cartForm').data("stripe-publishable-key"), {
        locale: appLocale
    });
}

export function renderCardForm() {

    const style = {
        base: {
            iconColor: global.colors.secondary_two,
            color: global.colors.secondary_two,
            fontWeight: 500,
            fontSize: '16px',
            padding: '16px',
            fontSmoothing: 'antialiased',
            ':-webkit-autofill': {
                color: global.colors.secondary_two,
            },
            '::placeholder': {
                color: global.colors.secondary,
            },
        },
        invalid: {
            iconColor: global.colors.primary,
            color: global.colors.primary,

        },

    }
    const elements = stripe.elements();

    cardElements = elements.create("card", {style: style});
    cardElements.mount("#card-element");

}

export async function getIntent() {

    try {
        const {data} = await axios.post('/payments/intent', {'payment_method': 'stripe_credit_card'})

        return data;

    } catch (e) {

        const cartException = new CartException(messages.error_payment[appLocale]);
        cartException.setName(messages.module[appLocale]);

        throw cartException;

    }
}

export async function confirmCard(clientSecret) {


    const {setupIntent, error} = await stripe.confirmCardSetup(clientSecret, {
        payment_method: {
            card: cardElements,
            billing_details: {
                name: 'Jenny Rosen'
            }
        }
    });


    if (error !== undefined) {

        let cardError = null;
        const declinedCode = error.decline_code !== '' ? error.decline_code : error.code;

        // search for locale stripe error payment
        switch (appLocale) {

            case 'es':
                cardError = esErrors.find(esError => esError.id === declinedCode);
                break;
            case 'en':
                cardError = enErrors.find(enError => enError.id === declinedCode);
                break;
        }


        const cartException = new CartException(messages.error_payment[appLocale]);
        cartException.setName(messages.module[appLocale]);

        if (cardError !== undefined) {
            cartException.setMessage(cardError.description + `<div class="mt-3 text-danger font-weight-bold text-italic">${cardError.steps}</div>`);
        } else {
            cartException.setMessage(messages.error_payment[appLocale]);
        }


        throw cartException;
    }


    if (setupIntent.status === 'succeeded') {
        return setupIntent.payment_method;
    }


}

export function showCardErrors() {

    cardElements.on('change', ({error}) => {

        const displayError = document.getElementById('card-errors');
        if (error) {
            displayError.textContent = error.message;
        } else {
            displayError.textContent = '';
        }
    });
}

export {stripe};
