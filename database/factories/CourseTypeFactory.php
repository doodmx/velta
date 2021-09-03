<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Course\CourseType;
use Faker\Generator as Faker;

$factory->define(CourseType::class, function (Faker $faker) {
    return [
        'name'        => $faker->word,
        'image'       => '',//'course_types/'.$faker->image(public_path('storage/course_types'), 200, 200, null, false),
        'description' => $faker->text(200)
    ];
});
