<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Blog\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'category' => $faker->word
    ];
});
