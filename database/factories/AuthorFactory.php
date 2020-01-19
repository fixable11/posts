<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Author;
use Faker\Generator as Faker;

$factory->define(Author::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'birthday' => $faker->date(),
        'info' => $faker->realText(300),
    ];
});
