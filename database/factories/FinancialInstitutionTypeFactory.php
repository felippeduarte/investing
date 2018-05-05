<?php

use Faker\Generator as Faker;

$factory->define(App\FinancialInstitutionType::class, function (Faker $faker) {
    return [
        'description' => $faker->word,
    ];
});
