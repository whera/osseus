<?php

declare(strict_types=1);

namespace Osseus;

use Osseus\Container\League\Container;
use Osseus\Contracts\Container\Container as ContainerContract;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * Class ApplicationTest
 *
 * @package Osseus
 */
class ApplicationTest extends TestCase
{
    /**
     * @var Application
     */
    private $app;


    /**
     * Set Up Test
     */
    protected function setUp()
    {
        $container = new Container();
        $this->app = new Application($container);

        return parent::setUp();
    }


    /**
     * Test instance app
     */
    public function testInstanceApp(): void
    {
        $this->assertInstanceOf(Application::class, $this->app);
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
     */
    public function testServiceNotExists()
    {
        $this->app->getService('wsw');
    }
}
