<?php

use Faker\Generator as Faker;

$factory->define(App\IndexRate::class, function (Faker $faker) {
    return [
        'index_id' => function() {
            return factory(App\Index::class)->create()->id;
        },
        'period_id' => function() {
            return factory(App\Period::class)->create()->id;
        },
        'value' => $faker->randomNumber(2),
    ];
});
