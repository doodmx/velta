<?php

namespace App\Exceptions\Payment;

use Exception;

class CartException extends Exception
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
            ], $this->getCode());
        }

        abort($this->getCode(), $this->getMessage());

    }
}
