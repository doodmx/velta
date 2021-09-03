<?php

namespace App\Http\Requests\Payment;

use App\Interfaces\Payment\CartInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Access\AuthorizationException;

class CreatePaymentRequest extends FormRequest
{

    private $error;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(CartInterface $cartContract)
    {

        $cart = $cartContract->show();

        if (empty($cart)) {
            $this->error = __('cart.already_paid');
            return false;
        }
        return true;
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException($this->error);
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'amount'                     => 'required|numeric',
            'currency_id'                => 'required|exists:currency,id',
            'description'                => 'required',
            'paymentToken'               => 'nullable',
            'payment_method'             => 'required|in:stripe_credit_card,paypal',
            'status'                     => 'required|in:paid,pendant'
        ];
    }
}
