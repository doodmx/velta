<?php

namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;

class SendPaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $bcc = $this->get('bcc');
        if (!empty($bcc)) {
            $bccArray = explode(',', $bcc);
            $this->merge([
                'bcc' => $bccArray
            ]);
        }


    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {


        return [
            'subject' => 'required',
            'email'   => 'required|email',
            'bcc.*'   => 'email'
        ];
    }
}
