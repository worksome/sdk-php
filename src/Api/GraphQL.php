<?php

declare(strict_types=1);

namespace Worksome\Sdk\Api;

use Worksome\Sdk\Exception\InvalidArgumentException;

class GraphQL extends AbstractApi
{
    /**
     * @param array<string, mixed> $variables
     *
     * @return array<int|string, mixed>|string
     */
    public function execute(string $query, array $variables = []): array|string
    {
        return $this->post('/graphql', [
            'query' => $query,
            'variables' => $variables,
        ]);
    }

    /**
     * @param array<string, mixed> $variables
     *
     * @return array<int|string, mixed>|string
     */
    public function fromFile(string $file, array $variables = []): array|string
    {
        if (! file_exists($file) || ! is_readable($file)) {
            throw new InvalidArgumentException('The provided file does not exist or is unreadable.');
        }

        return $this->execute((string) file_get_contents($file), $variables);
    }
}
