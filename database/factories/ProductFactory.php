<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'user_id' => auth()->id(),
        'name' => $faker->firstName,
        'branch' => $faker->lastName,
        'price' => $faker->randomNumber(3) * 100,
    ];
});