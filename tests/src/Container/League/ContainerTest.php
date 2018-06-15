<?php

declare(strict_types=1);

namespace Osseus\Container\League;

use League\Container\Container as ContainerLeague;
use PHPUnit\Framework\TestCase;
use stdClass;

class ContainerTest extends TestCase
{
    /**
     * @var Container
     */
    private $container;


    protected function setUp()
    {
        $this->container = new Container;

        return parent::setUp();
    }


    public function testInstanceServiceContainer()
    {
        $this->assertInstanceOf(Container::class, $this->container);
        $this->assertAttributeInstanceOf(ContainerLeague::class, 'container', $this->container);
    }


    public function testMethodAddReturnInstanceFluent()
    {
        $object = new stdClass();

        $container = $this->container->add('class', $object);

        $this->assertInstanceOf(Container::class, $container);
    }


    public function testMethodAddLazyReturnInstanceFluent()
    {
        $container = $this->container->addLazy('class', function () {
            return new stdClass();
        });

        $this->assertInstanceOf(Container::class, $container);
    }


    public function testInstanceService()
    {
        $class = new stdClass();

        $this->container->add('class', $class);

        $this->assertInstanceOf(stdClass::class, $this->container->get('class'));

        $this->assertSame($class, $this->container->get('class'));
    }


    public function testInstanceServiceLazy()
    {
        $class = new stdClass();

        $container = $this->container->addLazy('class', function() use ($class) {
            return $class;
        });

        $this->assertInstanceOf(stdClass::class, $this->container->get('class'));

        $this->assertSame($class, $this->container->get('class'));
    }


    public function testHasReturnsTrueForSharedDefinition()
    {
        $class = new stdClass();

        $this->container->add('class', $class);

        $this->assertTrue($this->container->has('class'));
    }

    public function testHasReturnsFalseForSharedDefinition()
    {
        $class = new stdClass();

        $this->container->add('class', $class);

        $this->assertFalse($this->container->has('classx'));
    }

    /**
     * Throw exception test in service not found
     *
     * @expectedException \Psr\Container\NotFoundExceptionInterface
     */
    public function testServiceNotExists()
    {
        $this->container->get('wsw');
    }
}
