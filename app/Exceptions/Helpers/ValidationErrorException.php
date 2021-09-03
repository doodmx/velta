<?php

namespace App\Exceptions\Helpers;

use Dotenv\Exception\ValidationException;
use Exception;
use Throwable;

class ValidationErrorException extends Exception
{


    /**
     * Render the exception as an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {

        $message = json_decode($this->getMessage());
        if ($request->isJson()) {
            return response()->json([
                'errors' => [
                    'code'   => 422,
                    'title'  => 'Error de validación',
                    'detail' => 'Tu petición está malformada o le faltan datos',
                    'meta'   => $message
                ]
            ], 422);
        }


        return redirect()->back()->withInput()->withErrors($message);


    }
}
