<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Blog\Blog;
use Faker\Generator as Faker;

$factory->define(Blog::class, function (Faker $faker) {
    return [
        'author'          => $faker->name,
        'title'           => $faker->name,
        'extract'         => $faker->text(150),
        'content'         => $faker->randomHtml(4, 4),
        'detail_image'    => '',//'blogs/' . $faker->image(public_path('storage/blogs'), 400, 300, null, false),
        'date_to_publish' => $faker->date('Y-m-d'),
        'time_to_publish' => $faker->time,
        'status'          => 1
    ];
});
