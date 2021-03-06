<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->text(20),
        'description' => $faker->text(),
        'image' => "https://picsum.photos/1000",
    ];
});
