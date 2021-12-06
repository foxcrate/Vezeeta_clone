<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\models\Finder;
use Faker\Generator as Faker;

$factory->define(Finder::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'phone' => $faker->e164PhoneNumber,
        'address' => $faker->address,
        'lat' => $faker->randomFloat(7, 30.1338824, 31.2682503), // 30.778054,30.782433
        'lng' => $faker->randomFloat(7, 30.1338824, 31.2682503), //30.989893,30.988500,
        'type'  => $faker->word,
    ];
});
