<?php

namespace App\Http\Controllers\Api\Auth;

use App\Notifications\Register;
use DB;
use Mail;
use Carbon\Carbon;
use App\Mail\SendUser;
use App\Interfaces\User\UserInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateAppUserRequest;

class RegisterController extends Controller
{
    protected $user;

    /**
     * RegisterController constructor.
     * @param UserInterface $user
     */
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    public function register(CreateAppUserRequest $request)
    {
        $user = $this->user->register($request, 'Investment');
        $user->notify(new Register(request('password')));

        return $this->user->login($request);
    }
}
