<?php

declare(strict_types=1);

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$path = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Autoload' . DIRECTORY_SEPARATOR;
$files = glob($path . '*.php');

array_walk($files, function (string $file) {
    if (file_exists($file)) {
        require_once $file;
    }
});

