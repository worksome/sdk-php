<?php

declare(strict_types=1);

use Worksome\Sdk\Exceptions\WorksomeException;

arch('debug functions are not used')
    ->expect(['dd', 'dump', 'var_dump', 'print_r', 'var_export', 'die', 'exit'])
    ->not->toBeUsed();

arch('Enums')
    ->expect('Worksome\Sdk\Enums')
    ->toBeEnums();

arch('Exceptions')
    ->expect('Worksome\Sdk\Exceptions')
    ->classes
    ->toExtend(Exception::class)
    ->toImplement(WorksomeException::class)
    ->toHaveSuffix('Exception');

arch('Requests')
    ->expect('Worksome\Sdk\Requests')
    ->toExtend('Saloon\Http\Request');

arch('Resources')
    ->expect('Worksome\Sdk\Resources')
    ->toExtend('Saloon\Http\BaseResource');
