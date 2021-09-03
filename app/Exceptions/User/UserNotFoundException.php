<?php

namespace App\Exceptions\Investment;

use Exception;

class UserNotFoundException extends Exception
{

    public function render($request)
    {
        if ($request->isJson()) {

            return response()->json([
                'errors' => [
                    'code'   => 404,
                    'title'  => __('api/user.not_found'),
                    'detail' => __('api/user.not_found_detail')
                ]
            ], 404);
        }

        return abort(404, __('api/user.not_found'));
    }
}
