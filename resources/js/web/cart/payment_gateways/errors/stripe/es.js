let esErrors;
export default esErrors = [
    {
        'id': 'authentication_required',
        'description': 'La tarjeta fue rechazada ya que la transacción requiere autenticación.',
        'steps': 'Intenta nuevamente y autentica tu tarjeta cuando se te solicite durante la transacción'
    },
    {
        'id': 'approve_with_id',
        'description': 'El pago no puede ser autorizado',
        'steps': 'Intenta nuevamente. Si aún no se puede procesar, comunícate con el emisor de tu tarjeta.'
    },
    {
        'id': 'call_issuer',
        'description': 'La tarjeta ha sido rechazada por una razón desconocida.',
        'steps': 'Comunícate con el emisor de tu tarjeta para obtener más información.'
    },
    {
        'id': 'card_not_supported',
        'description': 'La tarjeta no admite este tipo de compra',
        'steps': 'Comunícate con el emisor de tu tarjeta para asegurarse de que tu tarjeta se pueda usar para realizar este tipo de compra.'
    },
    {
        'id': 'card_velocity_exceeded',
        'description': 'Has excedido el saldo o límite de crédito disponible en tu tarjeta.',
        'steps': 'Comunícate con el emisor de tu tarjeta para obtener más información.'
    },
    {
        'id': 'currency_not_supported',
        'description': 'La tarjeta no admite la moneda especificada.',
        'steps': 'Verifica con el emisor si la tarjeta se puede usar para el tipo de moneda especificado.'
    },
    {
        'id': 'do_not_honor',
        'description': 'La tarjeta ha sido rechazada por una razón desconocida.',
        'steps': 'Comunícate con el emisor de tu tarjeta para obtener más información.'
    },
    {
        'id': 'do_not_honor',
        'description': 'La tarjeta ha sido rechazada por una razón desconocida.',
        'steps': 'Comunícate con el emisor de tu tarjeta para obtener más información.'
    },
    {
        'id': 'do_not_try_again',
        'description': 'La tarjeta ha sido rechazada por una razón desconocida.',
        'steps': 'Comunícate con el emisor de tu tarjeta para obtener más información.'
    },
    {
        'id': 'duplicate_transaction',
        'description': 'Recientemente se envió una transacción con la misma cantidad e información de tarjeta de crédito.',
        'steps': 'Verifica si ya existe un pago reciente para este concepto.'
    },
    {
        'id': 'expired_card',
        'description': 'Tu tarjeta ha expirado.',
        'steps': 'Por favor usa una tarjeta vigente.'
    },
    {
        'id': 'fraudulent',
        'description': 'La transacción ha sido rechazado por posible pago fraudulento .',
        'steps': 'Por favor usa una tarjeta vigente.'
    },
    {
        'id': 'generic_decline',
        'description': 'La tarjeta ha sido rechazada por una razón desconocida.',
        'steps': 'Comunícate con el emisor de tu tarjeta para obtener más información.'
    },
    {
        'id': 'incorrect_number',
        'description': 'El número de tarjeta es incorrecto.',
        'steps': 'Verifica que el número de tarjeta sea el correcto.'
    },
    {
        'id': 'incorrect_cvc',
        'description': 'El código de seguridad es incorrecto',
        'steps': 'Verifica que el código sea el correcto'
    },
    {
        'id': 'incorrect_pin',
        'description': 'El PIN ingresado es incorrecto. Este código de rechazo solo se aplica a los pagos realizados con un lector de tarjetas.',
        'steps': 'El cliente debe intentarlo nuevamente con el PIN correcto.'
    },
    {
        'id': 'incorrect_zip',
        'description': 'El código postal es incorrecto.',
        'steps': 'Verifica tu código postal'
    },
    {
        'id': 'insufficient_funds',
        'description': 'La tarjeta no tiene fondos suficientes para completar la compra.',
        'steps': 'Utiliza una tarjeta con saldo suficiente para completar tu compra.'
    },
    {
        'id': 'invalid_account',
        'description': 'La tarjeta, o la cuenta a la que está conectada, no es válida.',
        'steps': 'Comunícate con el emisor de tu tarjeta para verificar que la tarjeta funciona correctamente.'
    },
    {
        'id': 'invalid_amount',
        'description': 'El monto del pago no es válido o excede el monto permitido.',
        'steps': 'Si el monto parece ser correcto, verifica con el emisor de tu tarjeta que puedes realizar compras por dicha cantidad.'
    },
    {
        'id': 'invalid_amount',
        'description': 'El monto del pago no es válido o excede el monto permitido.',
        'steps': 'Si el monto parece ser correcto, verifica con el emisor de tu tarjeta que puedes realizar compras por dicha cantidad.'
    },
    {
        'id': 'invalid_cvc',
        'description': 'El número CVC es incorrecto.',
        'steps': 'Verifica el CVC en tu tarjeta'
    },
    {
        'id': 'invalid_expiry_year',
        'description': 'El año de vencimiento no es válido.',
        'steps': 'Verifica el año de vencimiento en tu tarjeta'
    },
    {
        'id': 'invalid_number',
        'description': 'El número de tarjeta no es válido.',
        'steps': 'Verifica el número en tu tarjeta'
    },
    {
        'id': 'invalid_pin',
        'description': 'El PIN no es válido.',
        'steps': 'Intenta nuevamente'
    },
    {
        'id': 'issuer_not_available',
        'description': 'No se pudo contactar al emisor de la tarjeta, por lo que no se pudo autorizar el pago.',
        'steps': 'Intenta nuevamente, si aún no se puede procesar, comunícate con el emisor de tu tarjeta.'
    },
    {
        'id': 'lost_card',
        'description': 'El pago ha sido rechazado porque la tarjeta se reporta perdida.',
        'steps': ''
    },
    {
        'id': 'merchant_blacklist',
        'description': 'El pago se ha rechazado porque coincide con un valor en la lista de bloqueo.',
        'steps': ''
    },
    {
        'id': 'new_account_information_available',
        'description': 'La tarjeta, o la cuenta a la que está conectada, no es válida.',
        'steps': 'Comunícate con el emisor de tu tarjeta para obtener más información.'
    },
    {
        'id': 'no_action_taken',
        'description': 'La tarjeta ha sido rechazada por una razón desconocida.',
        'steps': 'Comunícate con el emisor de tu tarjeta para obtener más información.'
    },
    {
        'id': 'not_permitted',
        'description': 'El pago no está permitido.',
        'steps': 'Comunícate con el emisor de tu tarjeta para obtener más información.'
    },
    {
        'id': 'pickup_card',
        'description': 'La tarjeta no se puede utilizar para realizar este pago (es posible que se haya reportado como extraviada o robada).',
        'steps': 'Comunícate con el emisor de tu tarjeta para obtener más información.'
    },
    {
        'id': 'pin_try_exceeded',
        'description': 'Se ha excedido el número permitido de intentos de PIN',
        'steps': 'Utiliza otra tarjeta'
    },
    {
        'id': 'processing_error',
        'description': 'Se produjo un error al procesar la tarjeta.',
        'steps': 'Intenta nuevamente, si aún no se puede procesar, comunícate con el emisor de tu tarjeta.'
    },
    {
        'id': 'reenter_transaction',
        'description': 'El emisor de la tarjeta no pudo procesar el pago por un motivo desconocido.',
        'steps': 'Intenta nuevamente, si aún no se puede procesar, comunícate con el emisor de tu tarjeta.'
    },
    {
        'id': 'restricted_card',
        'description': 'La tarjeta no se puede utilizar para realizar este pago (es posible que se haya reportado como extraviada o robada).',
        'steps': 'Comunícate con el emisor de tu tarjeta para más información.'
    },
    {
        'id': 'revocation_of_all_authorizations',
        'description': 'La tarjeta ha sido rechazada por una razón desconocida.',
        'steps': 'Comunícate con el emisor de tu tarjeta para más información.'
    },
    {
        'id': 'revocation_of_authorization',
        'description': 'La tarjeta ha sido rechazada por una razón desconocida.',
        'steps': 'Comunícate con el emisor de tu tarjeta para más información.'
    },
    {
        'id': 'security_violation',
        'description': 'La tarjeta ha sido rechazada por una razón desconocida.',
        'steps': 'Comunícate con el emisor de tu tarjeta para más información.'
    },
    {
        'id': 'service_not_allowed',
        'description': 'La tarjeta ha sido rechazada por una razón desconocida.',
        'steps': 'Comunícate con el emisor de tu tarjeta para más información.'
    },
    {
        'id': 'stolen_card',
        'description': 'El pago ha sido rechazado porque la tarjeta fue reportada como robada.',
        'steps': 'Comunícate con el emisor de tu tarjeta para más información.'
    },
    {
        'id': 'stop_payment_order',
        'description': 'La tarjeta ha sido rechazada por una razón desconocida.',
        'steps': 'Comunícate con el emisor de tu tarjeta para más información.'
    },
    {
        'id': 'testmode_decline',
        'description': 'Utilizaste una tarjeta para pruebas de desarrollo de software.',
        'steps': 'Utiliza una tarjeta válida.'
    },
    {
        'id': 'transaction_not_allowed',
        'description': 'La tarjeta ha sido rechazada por una razón desconocida.',
        'steps': 'Comunícate con el emisor de tu tarjeta para más información.'
    },
    {
        'id': 'try_again_later',
        'description': 'La tarjeta ha sido rechazada por una razón desconocida.',
        'steps': 'Intenta nuevamente, si aún no se puede procesar, comunícate con el emisor de tu tarjeta.'
    },
    {
        'id': 'withdrawal_count_limit_exceeded',
        'description': 'Has excedido el saldo o límite de crédito disponible en tu tarjeta.',
        'steps': 'Comunícate con el emisor de tu tarjeta para obtener más información.'
    },
    {
        'id': 'withdrawal_count_limit_exceeded',
        'description': 'Has excedido el saldo o límite de crédito disponible en tu tarjeta.',
        'steps': 'Comunícate con el emisor de tu tarjeta para obtener más información.'
    }
];
