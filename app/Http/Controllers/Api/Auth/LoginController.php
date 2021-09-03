<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Interfaces\User\UserInterface;
use App\Http\Requests\User\LoginRequest;

class LoginController extends Controller
{
    protected $user;

    public function __construct(UserInterface $user){
        $this->user = $user;
    }

    /**
     * @param LoginRequest $request
     * @return mixed
     */
    public function login(LoginRequest $request)
    {
        return $this->user->login($request);
    }

    public function logout(){
        return $this->user->logout();
    }
}
