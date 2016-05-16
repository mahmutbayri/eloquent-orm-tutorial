<?php

$factory->define(Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});

$factory->define(Models\Product::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(Models\Order::class, function (Faker\Generator $faker){
    return [
        'user_id' => $faker->randomElement(Models\User::all()->pluck('id')->toArray()),
    ];
});