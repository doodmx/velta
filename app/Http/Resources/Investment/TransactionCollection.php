<?php

namespace App\Http\Resources\Investment;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TransactionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data'  => $this->collection,
            'links' => [
                'self' => url('api/investments' . $this->collection[0]->investment_id . '/transactions')
            ]
        ];
    }
}
