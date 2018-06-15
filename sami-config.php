<?php

declare(strict_types=1);

use Sami\Sami;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->in(__DIR__ . DIRECTORY_SEPARATOR . 'src');

$path = __DIR__ . DIRECTORY_SEPARATOR . 'docs' . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR;

return new Sami(
    $iterator,
    [
        'theme'     => 'default',
        'title'     => 'Osseus API',
        'build_dir' => $path . 'html',
        'cache_dir' => $path . 'cache',
    ]
);
