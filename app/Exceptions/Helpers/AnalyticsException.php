<?php

namespace App\Exceptions\Helpers;

use Exception;

class AnalyticsException extends Exception
{

    public function render($request)
    {
        return response()->json([
            'errors' => [
                'code'   => 500,
                'title'  => 'Hubo un error en la conexión con Google Analytics',
                'detail' => 'Verifique que la conexión este correctamente configurada. '.$this->getMessage()
            ]
        ], 500);

    }
}
