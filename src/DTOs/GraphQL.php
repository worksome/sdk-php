<?php

declare(strict_types=1);

namespace Worksome\Sdk\DTOs;

use Saloon\Http\Response;

/**
 * @template TData of array<string, mixed>
 *
 * @phpstan-type GraphQLError array{message: string, path?: list<string>, extensions: mixed}
 */
readonly class GraphQL
{
    /**
     * @param TData|null              $data
     * @param list<GraphQLError>|null $errors
     */
    public function __construct(
        public array|null $data,
        public array|null $errors,
    ) {
    }

    /** @return self<array<string, mixed>> */
    public static function fromResponse(Response $response): self
    {
        /** @var array{data?: TData, errors?: list<GraphQLError>} $json */
        $json = $response->json();

        return new self(
            data: $json['data'] ?? null,
            errors: $json['errors'] ?? null,
        );
    }
}
