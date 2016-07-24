<?php

$dir = __DIR__ . '/../src';

$iterator = Symfony\Component\Finder\Finder::create()
    ->files()
    ->name('*.php')
    ->in($dir);

$options = [
    'theme'                => 'default',
    'title'                => 'Laravel Tactician API Documentation',
    'build_dir'            => __DIR__ . '/../build/laravelTactician',
    'cache_dir'            => __DIR__ . '/../cache/laravelTactician',
];

$sami = new Sami\Sami($iterator, $options);

return $sami;
