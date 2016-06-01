<?php

use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;

require_once __DIR__ . '/../init.php';

/** @var Filesystem $filesystem */
$filesystem = $ioc->make(Filesystem::class);

$files = $filesystem->glob(__DIR__.'/../migrations/*_*.php');


$files = array_map(function ($file) {
    return str_replace('.php', '', basename($file));
}, $files);


foreach ($files as $file) {
    $filesystem->requireOnce(__DIR__.'/../migrations/'.$file.'.php');

    $file = implode('_', array_slice(explode('_', $file), 4));

    $class = $ioc->make(Str::studly($file))->up();
}
