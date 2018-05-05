<?php

use Faker\Generator as Faker;

$factory->define(App\InvestmentType::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});
