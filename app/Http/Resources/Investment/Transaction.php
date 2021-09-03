<?php

namespace App\Http\Resources\Investment;

use App\Http\Resources\Investment\Currency as CurrencyResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Transaction extends JsonResource
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
                'type'           => 'transactions',
                'transaction_id' => $this->id,
                'attributes'     => [
                    'amount'     => number_format($this->amount, 2, '.', ''),
                    'balance'    => number_format($this->balance, 2, '.', ''),
                    'start_date' => isset($this->start_date) ? $this->start_date : null,
                    'end_date'   => isset($this->end_date) ? $this->end_date : null,
                    'created_at' => isset($this->created_at) ? $this->created_at : null,
                    'type'       => $this->type, //__('api/transaction.' . $this->type),
                    'status'     => __('api/transaction.' . $this->status)

                ],
                'links'          => [
                    'self' => url('api/investments/' . $this->investment_id . '/transactions/' . $this->id)
                ]
            ]
        ];
    }
}
