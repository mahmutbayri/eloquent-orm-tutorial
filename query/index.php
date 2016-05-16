<?php

require __DIR__ . '/../init.php';

/** @var \Illuminate\Filesystem\Filesystem $filesystem */
$filesystem = $ioc->make(\Illuminate\Filesystem\Filesystem::class);

$folderName = pathinfo(__DIR__, PATHINFO_FILENAME);

//klasördeki dosyalar
$files = collect($filesystem->glob(__DIR__.'/*_*.php'));

$files->each(function ($file) use($folderName) {
    $baseFileName = str_replace('.php', '', basename($file));
    echo '<li><a href="' . $folderName . '/' . $baseFileName . '.php">' . $baseFileName . '</a></i>';
});
