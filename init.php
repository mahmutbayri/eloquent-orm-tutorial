<?php

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager;

require __DIR__ . '/vendor/autoload.php';

$ioc = new Container;
$manager = new Manager($ioc);
$dispatcher = new Dispatcher($ioc);

$manager->setEventDispatcher($dispatcher);
$manager->bootEloquent();
$manager->setAsGlobal();

$connections = [
    'mysql' => [
        'driver'    => 'mysql',
        'host'      => '127.0.0.1',
        'database'  => 'homestead',
        'username'  => 'homestead',
        'password'  => 'secret',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
        'strict'    => false,
    ],
    'sqlite' => [
        'driver' => 'sqlite',
        'database' => ':memory:'
    ],
];

$manager->addConnection($connections['sqlite']);

////////////////////////////////////////////////

if ('cli' !== PHP_SAPI) {
    $manager->connection()->listen(function (QueryExecuted $queryExecuted) {

        $sql = $queryExecuted->sql;
        $bindings = $queryExecuted->bindings;

        if (
            starts_with($sql, ['truncate', 'create', 'delete', 'drop', 'alter'])
            || str_contains($sql, ['sqlite_master', 'information_schema', 'INFORMATION_SCHEMA'])
        ) {
            return;
        }

        $sql = str_replace(array('%', '?'), array('%%', '%s'), $sql);

        $sql = vsprintf($sql, $bindings);

        SqlFormatter::$pre_attributes = 'style="background:#18171b;color:#1299da;padding:5px;"';
        SqlFormatter::$word_attributes = 'style="color:white;"';
        SqlFormatter::$backtick_quote_attributes = 'style="color: #56db3a;"';


        $sql = SqlFormatter::format($sql);

        $time_now = (new DateTime)->format('H:i:s');;

        $log = "";

        //$log = $time_now . ' | ' . $time . 'ms | ';

        $log .= $sql . PHP_EOL;

        echo '<p>' . $log . '</p>';
    });

    print_r(str_replace('Example', '', studly_case(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME))));
}
if ($manager->getConnection()->getDriverName() == 'sqlite') {
    include 'prepare/migrate.php';
} else{
    $manager->connection()->statement(
        "S" . "ELECT Concat('TRUNCATE TABLE ',table_schema,'.',TABLE_NAME, ';')
        FROM INFORMATION_SCHEMA.TABLES where  table_schema in ('homestead')"
    );
}
