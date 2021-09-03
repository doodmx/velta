<?php

namespace App\Exceptions\Helpers;

use Exception;
use Throwable;

class PermissionException extends Exception
{

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Render the exception as an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        if ($request->isJson()) {
            return response()->json([
                'errors' => [
                    'code'   => 403,
                    'title'  => $this->message,
                    'detail' => __('api/errors.permission_detail')
                ]
            ], 403);
        }


        abort(403,$this->message);
    }
}
