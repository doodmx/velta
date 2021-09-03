<?php

namespace App\Exceptions\Helpers;

use Exception;

class DatabaseException extends Exception
{

    public function render($request)
    {
        return response()->json([
            'errors' => [
                'code'   => 500,
                'title'  => __('api/errors.database_title'),
                'detail' => __('api/errors.database_detail')
            ]
        ], 500);

    }
}
