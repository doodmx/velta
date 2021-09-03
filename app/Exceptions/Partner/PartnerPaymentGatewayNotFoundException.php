<?php

namespace App\Exceptions\Partner;

use Exception;

class PartnerPaymentGatewayNotFoundException extends Exception
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
                'message' => 'No se encontró tu información de pago'
            ], 404);
        }

        abort(404, 'No se encontró tu información de pago');
    }
}
