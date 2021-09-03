<?php

namespace App\Http\Requests\Lead;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentMailRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'     => 'required',
            'lastname' => 'required',
            'email'    => 'required:email',
            'whatsapp' => 'required'
        ];
    }
}
