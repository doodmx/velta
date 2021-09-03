<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ResetCredentialsRequest extends FormRequest
{

    public function authorize()
    {
        $authId = auth()->user()->id;
        $userId = $this->id;
        $isSuperAdmin = auth()->user()->hasRole('Super Admin');
        $canResetCredentials = auth()->user()->hasPermissionTo('reset_credentials');


        if ($isSuperAdmin || $authId === $userId) {
            return true;
        }

        return $canResetCredentials;


    }

    public function rules()
    {
        return [

        ];
    }
}
