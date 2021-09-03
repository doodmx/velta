<?php

namespace App\Http\Resources\Investment;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Investment\Plan as PlanResource;
use App\Http\Resources\Investment\Report as ReportResource;
use App\Http\Resources\Investment\Currency as CurrencyResource;
use App\Http\Resources\Investment\Transaction as TransactionResource;

class Investment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {

        $available = $this->balance;
        if (isset($this->profit) && isset($this->withdrawal)) {
            $available = ($this->balance + $this->profit) - $this->withdrawal;
        }

        return [
            'data' => [
                'type'          => 'investments',
                'investment_id' => $this->id,
                'attributes'    => [
                    'start_date'        => $this->start_date,
                    'end_date'          => $this->end_date,
                    'deposit'           => number_format($this->balance, 2, '.', ''),
                    'profit'            => isset($this->profit) ? number_format($this->profit, 2, '.', '') : null,
                    'withdrawals'       => isset($this->withdrawal) ? number_format($this->withdrawal, 2, '.', '') : null,
                    'available'         => number_format($available, 2, '.', ''),
                    'profit_percentage' => number_format($this->profit_percentage, 2, '.', ''),
                    'period_in_years'   => $this->period_in_years,
                    'status'            => __('api/investment.' . $this->status)

                ],
                'relationships' => [
                    'plan'         => new PlanResource($this->plan),
                    'currency'     => new CurrencyResource($this->currency),
                    'reports'      => ReportResource::collection($this->whenLoaded('reports')),
                    'transactions' => TransactionResource::collection($this->whenLoaded('transactions'))

                ],
                'links'         => [
                    'self' => url('api/investments/' . $this->id)
                ]
            ]
        ];
    }
}
