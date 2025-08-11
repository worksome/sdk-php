<?php

declare(strict_types=1);

namespace Worksome\Sdk\Exceptions\GraphQL;

use Worksome\Sdk\DTOs\GraphQL;
use Worksome\Sdk\Exceptions\WorksomeException;

class InvalidResponseException extends \RuntimeException implements WorksomeException
{
    public function __construct(public readonly GraphQL $response)
    {
        parent::__construct('Invalid GraphQL response');
    }
}
