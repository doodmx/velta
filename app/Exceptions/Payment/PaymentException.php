<?php

namespace App\Exceptions\Payment;

use Exception;

class PaymentException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {


        if ($request->isJson()) {
            return response()->json([
                'message' => $this->getMessage()
            ], 500);
        }

        abort(500, $this->getMessage());
    }
}
