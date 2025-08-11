<?php

declare(strict_types=1);

namespace Worksome\Sdk\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;
use Worksome\Sdk\DTOs\GraphQL;

class GraphQLRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /** @param  array<string, mixed>  $variables */
    public function __construct(
        protected string $graphQuery,
        protected array $variables = [],
    ) {
    }

    /** @return  array<string, mixed> */
    protected function defaultBody(): array
    {
        return [
            'query' => $this->graphQuery,
            ...($this->variables !== [] ? ['variables' => $this->variables] : []),
        ];
    }

    public function resolveEndpoint(): string
    {
        return '/graphql';
    }

    /** {@inheritdoc} */
    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
        ];
    }

    /** @return GraphQL<array<string, mixed>> */
    public function createDtoFromResponse(Response $response): GraphQL
    {
        return GraphQL::fromResponse($response);
    }
}
