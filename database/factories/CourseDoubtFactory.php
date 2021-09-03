<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Course\CourseDoubt;
use Faker\Generator as Faker;

$factory->define(CourseDoubt::class, function (Faker $faker) {
    return [
        'title'   => $faker->name,
        'content' => $faker->randomHtml()
    ];
});
