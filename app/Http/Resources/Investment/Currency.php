<?php

namespace App\Http\Resources\Investment;

use Illuminate\Http\Resources\Json\JsonResource;

class Currency extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data'  => [
                'type'        => 'currencies',
                'currency_id' => $this->id,
                'attributes'  => [
                    'iso_code'    => $this->iso_code,
                    'description' => $this->description,
                ]
            ],
            'links' => [
                'self' => url('api/currencies/' . $this->id)
            ]
        ];
    }
}
