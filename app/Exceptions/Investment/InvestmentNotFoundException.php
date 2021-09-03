<?php

namespace App\Exceptions\Investment;

use Exception;

class InvestmentNotFoundException extends Exception
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
                'errors' => [
                    'code'   => 404,
                    'title'  => __('api/investment.not_found'),
                    'detail' => __('api/investment.not_found_detail')
                ]
            ], 404);
        }

        return abort(404, __('api/investment.not_found'));
    }
}
