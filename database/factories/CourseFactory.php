<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Course\Course;

use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {


    return [
        'name'           => $faker->name,
        'excerpt'        => $faker->text(150),
        'thumbnail'      => '',//$faker->image(public_path('storage/courses'), 1020, 780, null, false),
        'description'    => $faker->realText,
        'total_chapters' => random_int(1, 20),
        'average_rate'   => $faker->randomFloat(1, 1, 5),
        'currency_id'    => random_int(1, 4),
        'price'          => $faker->randomFloat(2, 100, 600)
    ];
});
