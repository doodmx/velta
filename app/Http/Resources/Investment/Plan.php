<?php

namespace App\Http\Resources\Investment;

use App\Http\Resources\Investment\Currency as CurrencyResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Plan extends JsonResource
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
            'data' => [
                'type'          => 'plans',
                'plan_id'       => $this->id,
                'attributes'    => [
                    'thumbnail'         => empty($this->thumbnail) ? asset('img/default_plan.png') : asset('storage/plans/' . $this->thumbnail),
                    'name'              => $this->name,
                    'min_amount'        => number_format($this->min_amount, 2),
                    'profit_percentage' => number_format($this->profit_percentage, 2, '.',''),
                    'liquidity'         => __('api/plan.' . $this->liquidity)

                ],
                'relationships' => [
                    'currency' => new CurrencyResource($this->currency)
                ],
                'links'         => [
                    'self' => url('api/plans/' . $this->id)
                ]
            ]
        ];
    }
}
