<?php

use Faker\Generator as Faker;

$factory->define(App\FinancialInstitution::class, function (Faker $faker) {
    return [
        'full_name' => $faker->company,
        'short_name' => $faker->word,
        'financial_institution_type_id' => function() {
            return App\FinancialInstitutionType::class()->create()->id;
        },
    ];
});
