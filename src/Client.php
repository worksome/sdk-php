<?php

declare(strict_types=1);

namespace Worksome\Sdk;

use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\Plugin\RedirectPlugin;
use Http\Discovery\Psr17FactoryDiscovery;
use Psr\Http\Client\ClientInterface;
use Worksome\Sdk\Api\AbstractApi;
use Worksome\Sdk\Api\GraphQL;
use Worksome\Sdk\Enums\AuthMethod;
use Worksome\Sdk\Exception\BadMethodCallException;
use Worksome\Sdk\Exception\InvalidArgumentException;
use Worksome\Sdk\HttpClient\Builder;
use Worksome\Sdk\HttpClient\Plugin\Authentication;

/**
 * @method GraphQL graph()
 * @method GraphQL graphql()
 */
final class Client
{
    private Builder $httpClientBuilder;

    public function __construct(Builder $httpClientBuilder = null)
    {
        $this->httpClientBuilder = $builder = $httpClientBuilder ?? new Builder();

        $builder->addPlugin(new RedirectPlugin());
        $builder->addPlugin(
            new AddHostPlugin(Psr17FactoryDiscovery::findUriFactory()->createUri('https://api.worksome.com'))
        );
        $builder->addPlugin(new HeaderDefaultsPlugin([
            'User-Agent' => 'worksome-sdk (https://github.com/worksome/sdk-php)',
        ]));

        $builder->addHeaderValue('Accept', 'application/json');
    }

    public static function createWithHttpClient(ClientInterface $httpClient): self
    {
        $builder = new Builder($httpClient);

        return new self($builder);
    }

    /** @throws InvalidArgumentException */
    public function api(string $name): AbstractApi
    {
        return match ($name) {
            'graph', 'graphql' => new GraphQL($this),
            default => throw new InvalidArgumentException(
                sprintf('Undefined api instance called: "%s"', $name)
            ),
        };
    }

    public function authenticate(string $tokenOrLogin, AuthMethod $authMethod = AuthMethod::AccessToken): void
    {
        $this->getHttpClientBuilder()->removePlugin(Authentication::class);
        $this->getHttpClientBuilder()->addPlugin(new Authentication($tokenOrLogin, $authMethod));
    }

    /** @param array<int, mixed> $args */
    public function __call(string $name, array $args): AbstractApi
    {
        try {
            return $this->api($name);
        } catch (InvalidArgumentException $e) {
            throw new BadMethodCallException(
                sprintf('Undefined method called: "%s"', $name),
                $e->getCode(),
                $e
            );
        }
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->getHttpClientBuilder()->getHttpClient();
    }

    protected function getHttpClientBuilder(): Builder
    {
        return $this->httpClientBuilder;
    }
}
