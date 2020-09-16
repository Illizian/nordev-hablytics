<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Diary;
use Faker\Generator as Faker;

$factory->define(Diary::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(3),
    ];
});
