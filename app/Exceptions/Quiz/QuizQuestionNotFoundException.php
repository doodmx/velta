<?php

namespace App\Exceptions\Quiz;

use Exception;

class QuizQuestionNotFoundException extends Exception
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
                'message' => 'La pregunta solicitada no existe'
            ], 404);
        }

        abort(404, 'La pregunta solicitada no existe');
    }
}
