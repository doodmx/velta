<?php

namespace App\Exceptions\Blog;

use Exception;

class TagNotFoundException extends Exception
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
                'message' => 'La etiqueta solicitada no existe'
            ], 404);
        }

        abort(404, 'La etiqueta solicitada no existe');

    }
}
