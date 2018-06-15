<?php

declare(strict_types=1);

use Osseus\Application\Kernel;
use Osseus\Container\League\Container;

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$app = new Kernel(new Container);
$app->prepare();

return $app;