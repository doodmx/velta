<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'name'         => $faker->name,
        'lastname'     => $faker->lastName,
        'birth_date'   => $faker->date('Y-m-d'),
        'whatsapp' => $faker->e164PhoneNumber,
        'country_code' => $faker->countryCode,
        'photo'        => ''//'users/' . $faker->image(public_path('storage/users'), 400, 300, null, false),
    ];
});
