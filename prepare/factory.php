<?php

require __DIR__ . '/../init.php';
ini_set('memory_limit', '1024M');

/** @var Illuminate\Database\Eloquent\Factory $factory */
$factory = new Illuminate\Database\Eloquent\Factory(Faker\Factory::create());
$factory->load(__DIR__ . '/../factories');

Models\User::truncate();
Models\Order::truncate();
Models\Product::truncate();

$model = $factory->of(Models\User::class)->times(2)->create();
$model = $factory->of(Models\Order::class)->times(10)->create();
$model = $factory->of(Models\Product::class)->times(10)->create();
