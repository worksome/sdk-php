<?php

declare(strict_types=1);

namespace Worksome\Sdk\Api;

use Worksome\Sdk\Exception\InvalidResponseException;

class Viewer extends AbstractApi
{
    public function id(): string
    {
        /** @var array{data?: array{viewer: array{id: string}}} $response */
        $response = (new GraphQL($this->getClient()))->execute(
            <<<'GQL'
            {
                viewer {
                    id
                }
            }
            GQL
        );

        return $response['data']['viewer']['id'] ?? throw new InvalidResponseException($response);
    }

    /** @return array<int, array{id: string, name: string}> */
    public function accounts(): array
    {
        /** @var array{data?: array{accounts: array<int, array{id: string, name: string}>}} $response */
        $response = (new GraphQL($this->getClient()))->execute(
            <<<'GQL'
            {
                accounts {
                    id
                    name
                }
            }
            GQL
        );

        return $response['data']['accounts'] ?? throw new InvalidResponseException($response);
    }
}
