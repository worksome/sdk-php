<?php

declare(strict_types=1);

namespace Worksome\Sdk\Api;

class GraphQL extends AbstractApi
{
    /**
     * @param array<string, mixed> $variables
     *
     * @return array<int|string, mixed>|string
     */
    public function query(string $query, array $variables = []): array|string
    {
        return $this->post('/graphql', [
            'query' => $query,
            'variables' => $variables
        ]);
    }
}
