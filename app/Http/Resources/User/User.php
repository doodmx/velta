<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\Profile as ProfileResorce;

class User extends JsonResource
{

    public function toArray($request)
    {



        return [
            'data' => [
                'type'          => 'users',
                'user_id' => $this->id,
                'attributes'    => [
                    'email'        => $this->email,

                ],
                'relationships' => [
                    'profile'         => new ProfileResorce($this->profile),
                ],
                'links'         => [
                    'self' => url('api/users/' . $this->id)
                ]
            ]
        ];
    }
}
