<?php

declare(strict_types=1);

use Worksome\CodingStyle\WorksomeEcsConfig;

return WorksomeEcsConfig::configure()
    ->withPaths([
        __DIR__ . '/ecs.php',
        __DIR__ . '/rector.php',
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
    ->withSkip([
        Worksome\CodingStyle\Sniffs\Classes\ExceptionSuffixSniff::class,
    ]);
