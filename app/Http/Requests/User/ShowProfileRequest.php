<?php

namespace App\Http\Requests\User;

use App\Interfaces\User\UserInterface;
use Illuminate\Foundation\Http\FormRequest;

class ShowProfileRequest extends FormRequest
{


    public function authorize(UserInterface $userContract)
    {
        $authId = auth()->user()->id;
        $userId = intval($this->id);
        $isSuperAdmin = auth()->user()->hasRole('Super Admin');

        if ($isSuperAdmin || $authId === $userId) {
            return true;
        }

        $canEdit = auth()->user()->hasPermissionTo('edit_users');
        $anotherUser = $userContract->showById($userId);
        $userBelongsToMe = $authId === $anotherUser->partner_id;


        return $canEdit || $userBelongsToMe;


    }

    public function rules()
    {
        return [

        ];
    }
}
