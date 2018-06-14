<?php

declare(strict_types=1);

namespace Osseus\Container\League;

use League\Container\Container as ContainerLeague;
use Osseus\Contracts\Container\Container as ContainerContract;

/**
 * Container League
 *
 * @package Osseus\Container\League
 */
class Container implements ContainerContract
{

    /**
     * @var ContainerLeague
     */
    private $container;


    /**
     * Container constructor.
     */
    public function __construct()
    {
        $this->container = new ContainerLeague;
    }


    /**
     * Adds a new service to the container.
     *
     * @param string $name Service name.
     * @param mixed $service Service
     *
     * @return ContainerContract
     */
    public function add(string $name, $service): ContainerContract
    {
        $this->container->share($name, $service);

        return $this;
    }


    /**
     * Add a lazy service to the container.
     *
     * @param string $name Service name.
     * @param callable $callable Service.
     *
     * @return ContainerContract
     */
    public function addLazy(string $name, callable $callable): ContainerContract
    {
        $this->container->share($name, $callable);

        return $this;
    }


    /**
     * Finds an entry of the container by its identifier and returns it.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @throws \Psr\Container\NotFoundExceptionInterface  No entry was found for **this** identifier.
     * @throws \Psr\Container\ContainerExceptionInterface Error while retrieving the entry.
     *
     * @return mixed Entry.
     */
    public function get($id)
    {
        return $this->container->get($id);
    }


    /**
     * Returns true if the container can return an entry for the given identifier.
     * Returns false otherwise.
     *
     * `has($id)` returning true does not mean that `get($id)` will not throw an exception.
     * It does however mean that `get($id)` will not throw a `NotFoundExceptionInterface`.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @return bool
     */
    public function has($id): bool
    {
        return $this->container->has($id);
    }
}
