<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use App\Exceptions\Helpers\TokenAuthException;
use App\Exceptions\Helpers\PermissionException;
use Illuminate\Auth\Access\AuthorizationException;
use App\Exceptions\Helpers\ValidationErrorException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param \Throwable $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Throwable $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {



            if ($exception instanceof ValidationException) {
                throw new ValidationErrorException(json_encode($exception->errors()));
            }

            if ($exception instanceof AuthenticationException) {

                throw new TokenAuthException();
            }

            if ($exception instanceof AuthorizationException) {

                throw new PermissionException($exception->getMessage());
            }



        return parent::render($request, $exception);
    }
}
