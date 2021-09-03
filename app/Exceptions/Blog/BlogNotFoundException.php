<?php

namespace App\Exceptions\Blog;

use Exception;

class BlogNotFoundException extends Exception
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
                'message' => 'La publicación solicitada no existe'
            ], 404);
        }

        abort(404, 'La publicación solicitada no existe');

    }
}
