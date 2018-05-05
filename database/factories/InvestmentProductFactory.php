<?php

use Faker\Generator as Faker;

$factory->define(App\InvestmentProduct::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'financial_institution_id' => function() {
            return App\FinancialInstitution::class()->create()->id;
        },
        'investment_type_id' => function() {
            return App\InvestmentType::class()->create()->id;
        },
        'risk_level_id' => function() {
            return App\RiskLevel::class()->create()->id;
        },
    ];
});
