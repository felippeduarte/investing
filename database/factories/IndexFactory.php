<?php

use Faker\Generator as Faker;

$factory->define(App\Index::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});
