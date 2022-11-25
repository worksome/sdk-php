<?php

namespace Worksome\Sdk\Exception;

class InvalidResponseException extends \RuntimeException implements ExceptionInterface
{
    /** @param  array<int|string, mixed>|string  $response */
    public function __construct(public readonly array|string $response)
    {
        parent::__construct('Invalid response from API');
    }
}
