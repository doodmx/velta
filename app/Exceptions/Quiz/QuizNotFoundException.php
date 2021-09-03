<?php

namespace App\Exceptions\Quiz;

use Exception;

class QuizNotFoundException extends Exception
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
                'message' => 'El cuestionario solicitado no existe'
            ], 404);
        }

        abort(404, 'El cuestionario solicitado no existe');
    }
}
