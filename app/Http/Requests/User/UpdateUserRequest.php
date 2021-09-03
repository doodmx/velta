<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{

    public function authorize()
    {

        return auth()->user()->id === intval($this->id);
    }


    public function rules()
    {
        return [
            'name'     => 'required',
            'lastname' => 'required',
            'whatsapp' => 'required',
            'email'    => 'required|unique:user,email,' . $this->id . ',id'
        ];
    }
}
