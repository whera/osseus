<?php

declare(strict_types=1);

use Osseus\Application\Kernel;

if (!function_exists('app')) {

    /**
     * Alias instance Kernel
     *
     * @return Kernel
     */
    function app(): Kernel
    {
        global $app;

        return $app;
    }
}


if (!function_exists('config')) {

    /**
     * Return values to config.
     *
     * @param string $name Item name config
     *
     * @return mixed
     */
    function config(string $name)
    {
        return app()->getService('app.config')->get($name);
    }
}
