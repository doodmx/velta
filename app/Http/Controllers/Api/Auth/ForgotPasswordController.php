<?php

namespace App\Http\Controllers\Api\Auth;

use App\Notifications\SendResetLinkEmail;
use DB;
use Mail;
use Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\User\UserInterface;
use App\Http\Requests\User\ForgotRequest;

class ForgotPasswordController extends Controller
{

    protected $user;

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct(UserInterface $userContract)
    {
        $this->user = $userContract;
        $this->middleware('guest');
    }


    /**
     * Send token to reset password account
     * @param ForgotRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(ForgotRequest $request)
    {
        $user = $this->user->showByEmail($request->email);

        if (!$user) {
            return response()->json(["message" => __('api/auth.forgot.email')], 422);
        }

        try {
            DB::beginTransaction();

            $passwordToken = $this->user->forgotPassword($user);
            $user->notify(new SendResetLinkEmail($passwordToken->token));

            DB::commit();
            return response()->json(["message" => __('api/auth.forgot.success')], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(["message" => __('api/auth.forgot.error')], 400);
        }
    }
}
