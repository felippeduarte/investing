<?php

use Faker\Generator as Faker;

$factory->define(App\Period::class, function (Faker $faker) {
    return [
        'period' => $faker->word,
    ];
});
