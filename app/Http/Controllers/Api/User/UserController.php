<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ValidateEmailUserRequest;
use App\Interfaces\User\UserInterface;
use App\Notifications\CredentialsReset;
use App\Http\Requests\User\ShowUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Interfaces\Helpers\EncryptionInterface;
use App\Http\Resources\User\User as UserResource;
use App\Http\Requests\User\UpdateUserCredentialsRequest;


class UserController extends Controller
{

    private $users;

    public function __construct(UserInterface $userContract)
    {
        $this->users = $userContract;
    }


    public function showById($id, ShowUserRequest $request)
    {

        $user = $this->users->showById($id);
        return new UserResource($user);
    }

    public function updateProfile($id, UpdateUserRequest $request)
    {

        $user = $this->users->updateProfile($id, $request->all());

        return new UserResource($user);

    }

    public function resetCredentials($id, UpdateUserCredentialsRequest $request, EncryptionInterface $encryptionContract)
    {

        $data = $request->all();
        $data['password'] = $encryptionContract->encryptString($data['password']);


        $user = $this->users->updateCredentials($id, $data);
        $user->notify(new CredentialsReset($request['password']));

        return new UserResource($user);

    }

    public function validateEmail(ValidateEmailUserRequest $request)
    {
        return response()->json(null, 204);
    }

    public function validateCurrentPassword($id, EncryptionInterface $encryptionContract)
    {
        $user = $this->users->showById($id);
        $isCurrentPassword = $encryptionContract->checkEncryption(request('password'), $user->password);
        return response()->json(['is_current_password' => $isCurrentPassword], 200);
    }

}
