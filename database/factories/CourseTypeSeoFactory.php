<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Course\CourseTypeSeo;
use Faker\Generator as Faker;

$factory->define(CourseTypeSeo::class, function (Faker $faker) {
    return [
        'slug'        => $faker->slug,
        'title'       => $faker->name,
        'separator'   => '|',
        'image_alt' => $faker->text,
        'description' => $faker->text(150)
    ];
});
