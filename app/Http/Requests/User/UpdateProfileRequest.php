<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
        $memberships = implode(',', array_keys(config('memberships')));
        return [
            'email'           => 'nullable|email|unique:user,email,' . $this->id . ',id',
            'membership'      => 'nullable|in:' . $memberships,
            'name'            => 'required',
            'lastname'        => 'required',
            'whatsapp'        => 'required|regex:/^\+(?:[0-9]?){6,14}[0-9]$/',
            'photo'           => 'nullable|mimes:gif,jpg,jpeg,bmp,png',
            'id_card'         => 'nullable|mimes:gif,jpg,jpeg,bmp,png,pdf',
            'proof_residence' => 'nullable|mimes:gif,jpg,jpeg,bmp,png,pdf',
        ];
    }
}
