<?php

declare(strict_types=1);

namespace Worksome\Sdk\Resources;

use Saloon\Http\BaseResource;
use Worksome\Sdk\DTOs\GraphQL;
use Worksome\Sdk\Exceptions\GraphQL\InvalidResponseException;
use Worksome\Sdk\Worksome;

/** @property Worksome $connector */
class ViewerResource extends BaseResource
{
    public function id(): string
    {
        /** @var GraphQL<array{viewer: array{id: string}}> $response */
        $response = $this->connector->graph()->execute(
            <<<'GQL'
            {
                viewer {
                    id
                }
            }
            GQL
        );

        return $response->data['viewer']['id'] ?? throw new InvalidResponseException($response);
    }

    /** @return list<array{id: string, name: string}> */
    public function accounts(): array
    {
        /** @var GraphQL<array{accounts: list<array{id: string, name: string}>}> $response */
        $response = $this->connector->graph()->execute(
            <<<'GQL'
            {
                accounts {
                    id
                    name
                }
            }
            GQL
        );

        return $response->data['accounts'] ?? throw new InvalidResponseException($response);
    }

    /** @return array{id: string, email: string} */
    public function changeEmail(string $email): array
    {
        /** @var GraphQL<array{changeEmail: array{id: string, email: string}}> $response */
        $response = $this->connector->graph()->execute(
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

        return $response->data['changeEmail'] ?? throw new InvalidResponseException($response);
    }

    /** @return array{id: string, email: string} */
    public function sendVerificationEmail(): array
    {
        /** @var GraphQL<array{sendVerificationEmail: array{id: string, email: string}}> $response */
        $response = $this->connector->graph()->execute(
            <<<'GQL'
            mutation sendVerificationEmail {
                sendVerificationEmail {
                    id
                    email
                }
            }
            GQL,
        );

        return $response->data['sendVerificationEmail'] ?? throw new InvalidResponseException($response);
    }
}
