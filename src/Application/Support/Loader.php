<?php

declare(strict_types=1);

namespace Osseus\Application\Support;

use Dotenv\Dotenv;

/**
 * Trait responsible for loading application dependency files.
 *
 * @package Osseus\Application\Support
 */
trait Loader
{
    /**
     * Start all files autoload.
     *
     * @return void
     */
    protected function autoload(): void
    {
        $path = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'Autoload' . DIRECTORY_SEPARATOR;
        $files = glob($path . '*.php');

        array_walk($files, [$this, 'loadFile']);
    }

    /**
     * Load file .env
     *
     * @return void
     */
    protected function loadDotEnv(): void
    {
        (new Dotenv(dirname(dirname(dirname(__DIR__)))))->overload();
    }


    /**
     * Require file in app
     *
     * @param string $file absolute path to file.
     *
     * @return void
     */
    private function loadFile(string $file): void
    {
        if (file_exists($file)) {
            require_once $file;
        }
    }
}
