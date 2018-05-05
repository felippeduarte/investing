<?php

use Faker\Generator as Faker;

$factory->define(App\RiskLevel::class, function (Faker $faker) {
    return [
        'description' => $faker->word,
    ];
});
