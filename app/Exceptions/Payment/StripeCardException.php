<?php

namespace App\Exceptions\Payment;

use Exception;
use Throwable;

class StripeCardException extends Exception
{

    private $errors;

    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);


    }


    public function render($request)
    {



        if ($request->isJson()) {
            return response()->json([
                'message' => $this->getMessage()
            ], $this->getCode());
        }

        abort($this->getCode(), $this->getMessage());
    }
}
