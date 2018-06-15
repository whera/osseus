<?php

declare(strict_types=1);

namespace Osseus\ServiceProvider;

use Illuminate\Config\Repository;
use Osseus\Container\League\Container;
use Osseus\Contracts\ServiceProvider\ServiceProvider as ServiceProviderContract;
use phpDocumentor\Reflection\Types\Void_;
use PHPUnit\Framework\TestCase;
use Osseus\Contracts\Container\Container as ContainerContract;


/**
 * Class ConfigServiceProviderTest
 *
 * @package Osseus\ServiceProvider
 */
class ConfigServiceProviderTest extends TestCase
{

    /**
     * Test instance Contract
     *
     * @return void
     */
    public function testInstance(): void
    {
        $this->assertInstanceOf(ServiceProviderContract::class, new ConfigServiceProvider);
    }


    /**
     * Test Service Provider.
     *
     * @return void
     */
    public function testConfigServiceProvider(): void
    {
        $container = new Container();
        $provider = new ConfigServiceProvider;
        $provider->register($container);

        $this->assertInstanceOf(Repository::class, $container->get('app.config'));

    }
}
