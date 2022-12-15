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

    /** @return array{id: string, email: string} */
    public function changeEmail(string $email): array
    {
        /** @var array{data?: array{changeEmail: array{id: string, email: string}}} $response */
        $response = (new GraphQL($this->getClient()))->execute(
            <<<'GQL'
            mutation changeEmail($email: String!) {
                changeEmail(input: {email: $email}) {
                    id
                    email
                }
            }
            GQL,
            [
                'email' => $email,
            ]
        );

        return $response['data']['changeEmail'] ?? throw new InvalidResponseException($response);
    }

    /** @return array{id: string, email: string} */
    public function sendVerificationEmail(): array
    {
        /** @var array{data?: array{sendVerificationEmail: array{id: string, email: string}}} $response */
        $response = (new GraphQL($this->getClient()))->execute(
            <<<'GQL'
            mutation sendVerificationEmail {
                sendVerificationEmail {
                    id
                    email
                }
            }
            GQL
        );

        return $response['data']['sendVerificationEmail'] ?? throw new InvalidResponseException($response);
    }
}
