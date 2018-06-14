<?php

declare(strict_types=1);

use Sami\Sami;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->in(__DIR__ . DIRECTORY_SEPARATOR . 'src');

return new Sami(
    $iterator,
    [
        'theme'     => 'default',
        'title'     => 'Osseus API',
        'build_dir' => __DIR__ . DIRECTORY_SEPARATOR . 'docs' . DIRECTORY_SEPARATOR . 'build',
        'cache_dir' => __DIR__ . DIRECTORY_SEPARATOR . 'docs' . DIRECTORY_SEPARATOR . 'cache',
    ]
);
