<?php

declare(strict_types=1);

namespace Osseus\Contracts\ServiceProvider;

use Osseus\Contracts\Container\Container;

/**
 * Interface ServiceProvider
 *
 * @package Osseus\Contracts\ServiceProvider
 */
interface ServiceProvider
{

    /**
     * Register new Service in container.
     *
     * @param Container $container
     */
    public function register(Container $container): void;
}
