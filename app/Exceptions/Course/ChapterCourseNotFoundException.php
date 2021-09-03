<?php

namespace App\Exceptions\Course;

use Exception;

class ChapterCourseNotFoundException extends Exception
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
                'message' => 'El capítulo solicitado no existe'
            ], 404);
        }

        abort(404, 'El capítulo solicitado no existe');
    }
}
