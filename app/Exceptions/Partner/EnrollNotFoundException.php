<?php

namespace App\Exceptions\Partner;

use Exception;

class EnrollNotFoundException extends Exception
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
                'message' => 'Este curso no se encuentra en tu lista'
            ], 404);
        }

        abort(404, 'Este curso no se encuentra en tu lista');
    }
}
