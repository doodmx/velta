
let enErrors;

export default enErrors = [
    {
        'id': 'authentication_required',
        'description': 'The card was rejected since the transaction requires authentication.',
        'steps': 'Try again and authenticate your card when prompted during the transaction'
    },
    {
        'id': 'approve_with_id',
        'description': 'The payment was declined',
        'steps': 'Try again. If it still can\'t be processed, contact your card issuer.'
    },
    {
        'id': 'call_issuer',
        'description': 'The card has been rejected for an unknown reason.',
        'steps': 'Contact your card issuer for more information.'
    },
    {
        'id': 'card_not_supported',
        'description': 'The card does not support this type of purchase',
        'steps': 'Contact your card issuer to ensure that your card can be used to make this type of purchase.'
    },
    {
        'id': 'card_velocity_exceeded',
        'description': 'You have exceeded the balance or credit limit available on your card.',
        'steps': 'Contact your card issuer for more information.'
    },
    {
        'id': 'currency_not_supported',
        'description': 'The card does not support the specified currency.',
        'steps': 'Verify with the issuer whether the card can be used for the specified currency type.'
    },
    {
        'id': 'do_not_honor',
        'description': 'The card has been rejected for an unknown reason.',
        'steps': 'Contact your card issuer for more information.'
    },
    {
        'id': 'do_not_honor',
        'description': 'The card has been rejected for an unknown reason.',
        'steps': 'Contact your card issuer for more information.'
    },
    {
        'id': 'do_not_try_again',
        'description': 'The card has been rejected for an unknown reason.',
        'steps': 'Contact your card issuer for more information.'
    },
    {
        'id': 'duplicate_transaction',
        'description': 'Recently a transaction was sent with the same amount and credit card information.',
        'steps': 'Check if there is already a recent payment for this concept.'
    },
    {
        'id': 'expired_card',
        'description': 'Your card has expired',
        'steps': 'Please use a valid card.'
    },
    {
        'id': 'fraudulent',
        'description': 'The transaction has been rejected due to possible fraudulent payment',
        'steps': 'Please use a valid card.'
    },
    {
        'id': 'generic_decline',
        'description': 'The card has been rejected for an unknown reason.',
        'steps': 'Contact your card issuer for more information.'
    },
    {
        'id': 'incorrect_number',
        'description': 'The card number is incorrect',
        'steps': 'Verify that the card number is correct.'
    },
    {
        'id': 'incorrect_cvc',
        'description': 'The security code is incorrect',
        'steps': 'Verify that the code is correct'
    },
    {
        'id': 'incorrect_pin',
        'description': 'The entered PIN is incorrect. This rejection code only applies to payments made with a card reader.',
        'steps': 'The customer must try again with the correct PIN.'
    },
    {
        'id': 'incorrect_zip',
        'description': 'The zip code is incorrect.',
        'steps': 'Check your zip code'
    },
    {
        'id': 'insufficient_funds',
        'description': 'The card does not have sufficient funds to complete the purchase.',
        'steps': 'Use a card with sufficient balance to complete your purchase.'
    },
    {
        'id': 'invalid_account',
        'description': 'The card, or the account to which it is connected, is not valid.',
        'steps': 'Contact your card issuer to verify that the card is working properly.'
    },
    {
        'id': 'invalid_amount',
        'description': 'The payment amount is invalid or exceeds the allowed amount.',
        'steps': 'If the amount seems to be correct, check with your card issuer that you can make purchases for that amount.'
    },
    {
        'id': 'invalid_cvc',
        'description': 'The CVC number is incorrect',
        'steps': 'Check your CVC code on your card'
    },
    {
        'id': 'invalid_expiry_year',
        'description': 'The expiration year is not valid.',
        'steps': 'Check the expiration year on your card'
    },
    {
        'id': 'invalid_number',
        'description': 'The card number is not valid.',
        'steps': 'Check the number on your card'
    },
    {
        'id': 'invalid_pin',
        'description': 'The PIN is not valid.',
        'steps': 'Try again '
    },
    {
        'id': 'issuer_not_available',
        'description': 'Could not connect to the card issuer, so payment could not be authorized.',
        'steps': 'Please try again, if it still cannot be processed, please contact your card issuer.'
    },
    {
        'id': 'lost_card',
        'description': 'Payment has been declined because the card is reported as lost.',
        'steps': ''
    },
    {
        'id': 'merchant_blacklist',
        'description': 'The payment has been rejected because it matches a value in the block list.',
        'steps': ''
    },
    {
        'id': 'new_account_information_available',
        'description': 'The card, or the account to which it is connected, is not valid.',
        'steps': 'Contact your card issuer for more information.'
    },
    {
        'id': 'no_action_taken',
        'description': 'The card has been rejected for an unknown reason.',
        'steps': 'Contact your card issuer for more information.'
    },
    {
        'id': 'not_permitted',
        'description': 'The payment as declined',
        'steps': 'Contact your card issuer for more information.'
    },
    {
        'id': 'pickup_card',
        'description': 'The card cannot be used to make this payment (it may have been reported as lost or stolen).',
        'steps': 'Contact your card issuer for more information.'
    },
    {
        'id': 'pin_try_exceeded',
        'description': 'The allowed number of PIN attempts has been exceeded',
        'steps': 'Please try with another card'
    },
    {
        'id': 'processing_error',
        'description': 'An error occurred while processing the card.',
        'steps': 'Please try again, if it still cannot be processed, please contact your card issuer.'
    },
    {
        'id': 'reenter_transaction',
        'description': 'The card issuer was unable to process the payment for an unknown reason.',
        'steps': 'Please try again, if it still cannot be processed, please contact your card issuer.'
    },
    {
        'id': 'restricted_card',
        'description': 'The card cannot be used to make this payment (it may have been reported lost or stolen).',
        'steps': 'Contact your card issuer for more information..'
    },
    {
        'id': 'revocation_of_all_authorizations',
        'description': 'The card has been rejected for an unknown reason.',
        'steps': 'Contact your card issuer for more information..'
    },
    {
        'id': 'revocation_of_authorization',
        'description': 'The card has been rejected for an unknown reason.',
        'steps': 'Contact your card issuer for more information..'
    },
    {
        'id': 'security_violation',
        'description': 'The card has been rejected for an unknown reason.',
        'steps': 'Contact your card issuer for more information..'
    },
    {
        'id': 'service_not_allowed',
        'description': 'The card has been rejected for an unknown reason.',
        'steps': 'Contact your card issuer for more information..'
    },
    {
        'id': 'stolen_card',
        'description': 'The payment has been declined because the card was reported stolen.',
        'steps': 'Contact your card issuer for more information..'
    },
    {
        'id': 'stop_payment_order',
        'description': 'The card has been rejected for an unknown reason.',
        'steps': 'Contact your card issuer for more information..'
    },
    {
        'id': 'testmode_decline',
        'description': 'You used a card for software development testing.',
        'steps': 'Use a valid card.'
    },
    {
        'id': 'transaction_not_allowed',
        'description': 'The card has been rejected for an unknown reason.',
        'steps': 'Contact your card issuer for more information..'
    },
    {
        'id': 'try_again_later',
        'description': 'The card has been rejected for an unknown reason.',
        'steps': 'Please try again, if it still cannot be processed, please contact your card issuer.'
    },
    {
        'id': 'withdrawal_count_limit_exceeded',
        'description': 'You have exceeded the balance or credit limit available on your card.',
        'steps': 'Contact your card issuer for more information.'
    },
    {
        'id': 'withdrawal_count_limit_exceeded',
        'description': 'You have exceeded the balance or credit limit available on your card.',
        'steps': 'Contact your card issuer for more information.'
    }
];
