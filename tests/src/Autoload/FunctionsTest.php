<?php
declare(strict_types=1);

namespace Osseus\Autoload;

use Illuminate\Config\Repository;
use Osseus\Application\Kernel;
use PHPUnit\Framework\TestCase;

/**
 * Class FunctionsTest
 *
 * @package Osseus\Autoload
 */
class FunctionsTest extends TestCase
{

    /**
     * Test instance, exists and return from app function
     *
     * @return void
     */
    public function testInstanceAppFunction(): void
    {
        $this->assertTrue(function_exists('app'));
        $this->assertInstanceOf(Kernel::class, app());
    }


    /**
     * Test exists and return from config function.
     *
     * @return void
     */
    public function testInstanceConfigFunction(): void
    {
        $this->assertTrue(function_exists('config'));

        /** @var Repository $repo */
        $repo = app()->getService('app.config');
        $repo->set('test', ['name' => 'PHPUnit', 'createdBy' => 'Sebastian Bergmann']);

        $this->assertInternalType('array', config('test'));
        $this->assertEquals('PHPUnit', config('test.name'));
        $this->assertEquals('Sebastian Bergmann', config('test.createdBy'));
    }
}
