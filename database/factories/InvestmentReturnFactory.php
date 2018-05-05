<?php

use Faker\Generator as Faker;

$factory->define(App\InvestmentReturn::class, function (Faker $faker) {
    return [
        'investment_product_id' => function() {
            return App\InvestmentProduct::class()->create()->id;
        },
        'period_id' => function() {
            return App\Period::class()->create()->id;
        },
        'value' => $faker->randomFloat(2),
    ];
});
