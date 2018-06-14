<?php

declare(strict_types=1);

namespace Osseus\Contracts\Container;

use Psr\Container\ContainerInterface;

/**
 * Interface responsible for standardizing application dependency injection containers.
 *
 * @package Osseus\Contracts\Container
 */
interface Container extends ContainerInterface
{

    /**
     * Adds a new service to the container.
     *
     * @param string $name Service name.
     * @param mixed $service Service
     *
     * @return self
     */
    public function add(string $name, $service): self;


    /**
     * Add a lazy service to the container.
     *
     * @param string $name Service name.
     * @param callable $callable Service.
     *
     * @return self
     */
    public function addLazy(string $name, callable $callable): self;
}
