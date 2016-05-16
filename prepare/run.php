<?php

require __DIR__ . '/../init.php';

/** @var \Models\User $user */
$user = \Models\User::find(2);

/** @var \Models\Order $user */
$order = \Models\Order::find(2);

dd($order->products()->get());

//echo $order->user->name;
//dd($user->orders->toArray());





echo PHP_EOL;