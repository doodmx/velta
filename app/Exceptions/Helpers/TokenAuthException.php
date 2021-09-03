<?php

namespace App\Exceptions\Helpers;

use Exception;

class TokenAuthException extends Exception
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
                'errors' => [
                    'code'   => 401,
                    'title'  =>__('api/errors.auth_title'),
                    'detail' => __('api/errors.auth_detail')
                ]
            ], 401);
        }

        return redirect()->route('login');

    }
}
