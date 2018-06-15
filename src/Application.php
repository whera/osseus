<?php

declare(strict_types=1);

namespace Osseus;

use Osseus\Contracts\Container\Container as ContainerContract;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Application
 *
 * This is the primary class, configure, and run a Osseus Framework application.
 *
 * @package Osseus
 */
class Application
{
    /**
     * @var ContainerContract
     */
    private $container;


    /**
     * Application constructor.
     *
     * @param ContainerContract $container Container app
     */
    public function __construct(ContainerContract $container)
    {
        $this->container = $container;
    }


    /**
     * Enable access to the DI container by consumers.
     *
     * @return ContainerContract
     */
    public function getContainer(): ContainerContract
    {
        return $this->container;
    }


    /**
     * We deliver the requested service.
     *
     * @param string $serviceName Service name.
     *
     * @throws NotFoundExceptionInterface  No entry was found for **this** identifier.
     * @throws ContainerExceptionInterface Error while retrieving the entry.
     *
     * @return mixed
     */
    public function getService(string $serviceName)
    {
        return $this->container->get($serviceName);
    }


    /**
     * We've added a new service to our dependency container.
     *
     * @param string $name Service name.
     * @param mixed $service service.
     *
     * @return self
     */
    public function addService(string $name, $service): self
    {
        if (is_callable($service)) {
            $this->container->addLazy($name, $service);

            return $this;
        }

        $this->container->add($name, $service);

        return $this;
    }
}
