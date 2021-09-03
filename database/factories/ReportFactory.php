<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Investment\Report;
$factory->define(Report::class, function (Faker $faker) {

    return [
        'file'       => null,
        'note'       => '',
        'created_at' => now(),
    ];
});
