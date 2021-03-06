<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Coin;
use App\Market;
use App\User;
use Faker\Generator as Faker;

$factory->define(Market::class, function (Faker $faker) {
    return [
        "user_id" => function(){
            return User::all()->random();
        },
        "coin_id" => function(){
            return Coin::all()->random();
        },
        "type" => $faker->randomElement(['buy', 'sell']),
        "min" => $faker->numberBetween(0, 3),
        "max" => $faker->numberBetween(10, 100),
        "price_usd" => 9345.56,
        "price_ngn" => 4567345.34,
    ];
});
