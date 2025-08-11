<?php

declare(strict_types=1);

namespace Worksome\Sdk;

use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;
use Worksome\Sdk\Resources\GraphQLResource;
use Worksome\Sdk\Resources\ViewerResource;

class Worksome extends Connector
{
    use AcceptsJson;
    use AlwaysThrowOnErrors;

    public const string BASE_URI = 'https://api.worksome.com';

    public function __construct(
        protected string $apiToken,
        protected string $baseUri = self::BASE_URI,
        protected int $timeoutInSeconds = 10,
    ) {
    }

    public function graph(): GraphQLResource
    {
        return new GraphQLResource($this);
    }

    public function graphql(): GraphQLResource
    {
        return $this->graph();
    }

    public function viewer(): ViewerResource
    {
        return new ViewerResource($this);
    }

    public function resolveBaseUrl(): string
    {
        return $this->baseUri;
    }

    protected function defaultAuth(): TokenAuthenticator
    {
        return new TokenAuthenticator($this->apiToken);
    }

    protected function defaultHeaders(): array
    {
        return [
            'User-Agent' => 'worksome-sdk (https://github.com/worksome/sdk-php)',
        ];
    }

    protected function defaultConfig(): array
    {
        return [
            'timeout' => $this->timeoutInSeconds,
        ];
    }
}
