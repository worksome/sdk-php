<?php

declare(strict_types=1);

namespace Worksome\Sdk\Resources;

use Saloon\Http\BaseResource;
use Worksome\Sdk\DTOs\GraphQL;
use Worksome\Sdk\Exceptions\InvalidArgumentException;
use Worksome\Sdk\Requests\GraphQLRequest;

class GraphQLResource extends BaseResource
{
    /**
     * @param array<string, mixed> $variables
     *
     * @return GraphQL<array<string, mixed>>
     */
    public function execute(string $query, array $variables = []): GraphQL
    {
        $request = new GraphQLRequest($query, $variables);

        return $this->connector->send($request)->dto(); // @phpstan-ignore return.type
    }

    /**
     * @param array<string, mixed> $variables
     *
     * @return GraphQL<array<string, mixed>>
     */
    public function fromFile(string $file, array $variables = []): GraphQL
    {
        if (! file_exists($file) || ! is_readable($file)) {
            throw new InvalidArgumentException('The provided file does not exist or is unreadable.');
        }

        return $this->execute((string) file_get_contents($file), $variables);
    }
}
