<?php
// turn on all errors
error_reporting(E_ALL);

// composer autoloader
$composer_autoload = __DIR__ . "/vendor/autoload.php";
if (! is_readable($composer_autoload)) {
    echo "Did not find 'vendor/autoload.php'." . PHP_EOL;
    echo "Try ./phpunit.sh instead of phpunit." . PHP_EOL;
    exit(1);
}
require __DIR__ . '/vendor/aura/di/autoload.php';

// package autoloader
require dirname(dirname(__DIR__)) . '/autoload.php';
