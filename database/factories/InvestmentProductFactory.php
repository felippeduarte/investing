<?php

use Faker\Generator as Faker;

$factory->define(App\InvestmentProduct::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'financial_institution_id' => function() {
            return factory(App\FinancialInstitution::class)->create()->id;
        },
        'investment_type_id' => function() {
            return factory(App\InvestmentType::class)->create()->id;
        },
        'risk_level_id' => function() {
            return factory(App\RiskLevel::class)->create()->id;
        },
    ];
});
