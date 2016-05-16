<?php

require __DIR__ . '/vendor/autoload.php';

$ioc = new \Illuminate\Container\Container;
$manager = new \Illuminate\Database\Capsule\Manager;

$manager->addConnection([
    'driver'    => 'mysql',
    'host'      => '127.0.0.1',
    'database'  => 'homestead',
    'username'  => 'homestead',
    'password'  => 'secret',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
    'strict'    => false,
]);

$manager->setEventDispatcher(new \Illuminate\Events\Dispatcher($ioc));
$manager->setAsGlobal();
$manager->bootEloquent();

if ('cli' !== PHP_SAPI) {
    $manager->connection()->listen(function ($sql, $bindings, $time) {
        $sql = str_replace(array('%', '?'), array('%%', '%s'), $sql);
        $sql = vsprintf($sql, $bindings);
        $time_now = (new DateTime)->format('H:i:s');;
        $log = $time_now . ' | ' . $time . 'ms | ' . $sql . PHP_EOL;

        echo '<pre>' . $log . '</pre>';
    });
}

//$manager->connection()->query()->from()
