<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class Profile extends JsonResource
{

    public function toArray($request)
    {


        return [
            'data' => [
                'type'          => 'profiles',
                'investment_id' => $this->user_id,
                'attributes'    => [
                    'name'         => $this->name,
                    'lastname'     => $this->lastname,
                    'birth_date'   => $this->birth_date !== null ? $this->birth_date->format('d/m/Y') : null,
                    'country_code' => $this->country_code,
                    'whatsapp'     => $this->whatsapp,
                    'photo'        => $this->photo !== null ? asset('storage/' . $this->photo) : null,

                ],
                'links'         => [
                    'self' => url('api/users/' . $this->user_id)
                ]
            ]
        ];
    }
}
