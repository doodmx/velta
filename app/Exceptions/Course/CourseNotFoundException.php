<?php

namespace App\Exceptions\Course;

use Exception;

class CourseNotFoundException extends Exception
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
                'message' => 'El curso solicitado no existe'
            ], 404);
        }

        abort(404, 'El curso solicitado no existe');
    }

}
