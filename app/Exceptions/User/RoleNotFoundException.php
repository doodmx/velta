<?php

namespace App\Exceptions\Partner;

use Exception;

class RoleNotFoundException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        if ($request->isJson()) {
            return response()->json([
                'message' => 'El rol solicitado no existe'
            ], 404);
        }

        abort(404, 'El rol solicitado no existe');
    }
}
