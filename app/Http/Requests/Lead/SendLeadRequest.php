<?php

namespace App\Http\Requests\Lead;

use Illuminate\Foundation\Http\FormRequest;

class SendLeadRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'            => ['required', 'string', 'max:255'],
            'lastname'        => ['required', 'string', 'max:255'],
            'whatsapp'    => ['required', 'regex:/^\+(?:[0-9]?){6,14}[0-9]$/'],
            'email'           => ['required', 'string', 'email', 'max:255', 'unique:user'],
            'id_card'         => ['required', 'mimes:gif,jpg,jpeg,bmp,png,pdf'],
            'proof_residence' => ['required', 'mimes:gif,jpg,jpeg,bmp,png,pdf' ],
            'terms'           => ['required'],
        ];
    }

    public function attributes()
    {
        return [
            'name'            => __('web/forms.register.fields.name.placeholder'),
            'lastname'        => __('web/forms.register.fields.lastname.placeholder'),
            'whatsapp'    => __('web/forms.register.fields.whatsapp.placeholder'),
            'email'           => __('web/forms.register.fields.email.placeholder'),
            'id_card'         => __('web/forms.register.fields.id_card.placeholder'),
            'proof_residence' => __('web/forms.register.fields.proof_residence.placeholder'),
        ];
    }

    public function messages()
    {
        return [
            'terms.required' => __('web/forms.register.fields.terms.validate_msg.required')
        ];
    }
}
