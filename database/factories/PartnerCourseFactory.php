<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Partner\PartnerCourse;
use Faker\Generator as Faker;

$factory->define(PartnerCourse::class, function (Faker $faker) {
    return [
        'approval_certificate' => $faker->word,
        'chapter_progress'     => 0,
        'rate'                 => random_int(1, 5),
        'comment'              => $faker->realText(200)

    ];
});
