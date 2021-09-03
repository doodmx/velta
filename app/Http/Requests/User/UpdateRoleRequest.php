<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'role.name'     => 'required|unique:roles,name,' . $this->id . ',id',
            'permissions.*' => 'regex:/^[1-9]\d*$/|exists:permissions,id'
        ];
    }
}
