<?php

declare(strict_types=1);

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

if (!defined('ROOT_DIR')) {
    define('ROOT_DIR', dirname(dirname(__DIR__)) . DS);
}

if (!defined('APP_DIR')) {
    define('APP_DIR', ROOT_DIR . 'app' . DS);
}

if (!defined('PUBLIC_DIR')) {
    define('PUBLIC_DIR', ROOT_DIR . 'public' . DS);
}

if (!defined('CORE_DIR')) {
    define('CORE_DIR', ROOT_DIR . 'src' . DS);
}

if (!defined('TMP_DIR')) {
    define('TMP_DIR', ROOT_DIR . 'tmp' . DS);
}