<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ShowUserRequest extends FormRequest
{

    public function authorize()
    {

        return auth()->user()->id === intval($this->id);
    }


    public function rules()
    {
        return [
            //
        ];
    }
}
