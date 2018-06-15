<?php

declare(strict_types=1);

namespace Osseus\ServiceProvider;

use Illuminate\Config\Repository;
use Osseus\Contracts\Container\Container;
use Osseus\Contracts\ServiceProvider\ServiceProvider;

class ConfigServiceProvider implements ServiceProvider
{
    /**
     * @var array
     */
    private $itens = [];


    /**
     * Register new Service in container.
     *
     * @param Container $container
     */
    public function register(Container $container): void
    {
        $files = glob(CONFIG_DIR . '*.php');

        array_walk($files, [$this, 'handle']);

        $container->add('app.config', new Repository($this->itens));
    }


    /**
     * Prepare file list
     *
     * @param string $file absolute path to file.
     */
    private function handle(string $file): void
    {
        if (file_exists($file)) {
            $name = basename($file, '.php');
            $listValues = require_once $file;

            $this->itens[$name] = $listValues;
        }
    }
}
