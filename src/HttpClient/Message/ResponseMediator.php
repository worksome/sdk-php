<?php

namespace Worksome\Sdk\HttpClient\Message;

use Psr\Http\Message\ResponseInterface;

final class ResponseMediator
{
    /** @return array<string|int, mixed>|string */
    public static function getContent(ResponseInterface $response): array|string
    {
        $body = $response->getBody()->__toString();

        if (str_starts_with($response->getHeaderLine('Content-Type'), 'application/json')) {
            /** @var array<string|int, mixed> $content */
            $content = json_decode($body, true, 512, JSON_THROW_ON_ERROR);

            if (json_last_error() === JSON_ERROR_NONE) {
                return $content;
            }
        }

        return $body;
    }

    public static function getHeader(ResponseInterface $response, string $name): string|null
    {
        $headers = $response->getHeader($name);

        return array_shift($headers);
    }
}
