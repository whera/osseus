<?php

declare(strict_types=1);

namespace Osseus\Application;

use Osseus\Container\League\Container;
use Osseus\Contracts\Container\Container as ContainerContract;
use Osseus\Contracts\ServiceProvider\ServiceProvider as ServiceProviderContract;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * Class KernelTest
 *
 * @package Osseus\Application
 */
class KernelTest extends TestCase
{
    /**
     * @var Kernel
     */
    private $app;


    /**
     * Set Up Test
     */
    protected function setUp()
    {
        $this->app = new Kernel(new Container);

        return parent::setUp();
    }


    /**
     * Test instance app
     *
     * @return void
     */
    public function testInstanceApp(): void
    {
        $this->assertInstanceOf(Kernel::class, $this->app);
        $this->assertAttributeInstanceOf(ContainerContract::class, 'container', $this->app);
    }


    /**
     * Test get result container
     */
    public function testGetContainer(): void
    {
        $this->assertInstanceOf(ContainerContract::class, $this->app->getContainer());
    }


    /**
     * Test new Service injection DI
     *
     * @return void
     */
    public function testAddNewService(): void
    {
        $service = new stdClass();
        $service->name = 'Osseus';

        $this->app->addService('app.name', $service);

        $this->assertEquals($service, $this->app->getService('app.name'));
    }


    /**
     * Test new Service Lazy.
     *
     * @return void
     */
    public function testAddNewServiceCallable(): void
    {
        $service = new stdClass();
        $service->name = 'Osseus';

        $this->app->addService('app.name.callable', function () use ($service) {

            return $service;
        });

        $this->assertEquals($service, $this->app->getService('app.name.callable'));
    }


    /**
     * Throw exception test in service not found
     *
     * @expectedException \Psr\Container\NotFoundExceptionInterface
     *
     * @return void
     */
    public function testServiceNotExists(): void
    {
        $this->app->getService('wsw');
    }


    /**
     * Test resource add service provider.
     *
     * @return void
     */
    public function testRegisterServicePRovider(): void
    {
        $provider = new class implements ServiceProviderContract
        {

            public function register(ContainerContract $container): void
            {
                $container->add('test.nameFw', 'Osseus');

                $container->addLazy('test.languageFw', function () {
                        return 'PHP';
                });
            }
        };

        $this->app->addServiceProvider($provider);

        $this->assertEquals('Osseus', $this->app->getService('test.nameFw'));
        $this->assertEquals('PHP', $this->app->getService('test.languageFw'));
    }


    /**
     * Test load files.
     *
     * @return void
     */
    public function testMethodPrepare(): void
    {
        $this->app->prepare();

        $this->assertTrue(defined('ROOT_DIR'));

        $this->assertArrayHasKey('APP_NAME', $_ENV);
    }
}
