<?php

namespace App\Http\Resources\Investment;

use Illuminate\Http\Resources\Json\JsonResource;

class Report extends JsonResource
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
                'type'       => 'reports',
                'report_id'  => $this->id,
                'attributes' => [
                    'investment_id' => $this->investment_id,
                    'file'          => url('storage/'.$this->file),
                    'note'          => $this->note,
                    'created_at'    => $this->created_at,
                    'updated_at'    => $this->updated_at
                ],
                'links'      => [
                    'self' => url('api/reports/' . $this->id)
                ]
            ]
        ];
    }
}
