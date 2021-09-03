<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserCredentialsRequest extends FormRequest
{

    public function authorize()
    {

        return auth()->user()->id === intval($this->id);
    }


    public function rules()
    {
        return [
            'password' => 'required|min:6|confirmed',
        ];
    }
}
