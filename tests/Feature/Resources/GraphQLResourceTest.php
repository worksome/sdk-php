<?php

declare(strict_types=1);

use Saloon\Exceptions\Request\ClientException;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Worksome\Sdk\Requests\GraphQLRequest;

beforeEach(function () {
    $this->worksome = worksomeMock();
});

it('can query via the Graph API', function () {
    MockClient::global([
        GraphQLRequest::class => MockResponse::fixture('graphql-profile'),
    ]);

    $query = <<<'GQL'
query {
  profile {
    id
    email
  }
}
GQL;
    expect($this->worksome->graph()->execute($query))
        ->data->toBeArray()
        ->data->profile->toBeArray()
        ->data->profile->id->toBe('VXNlcjox')
        ->data->profile->email->toBe('admin@worksome.test');
});

it('can handle GraphQL error from invalid query', function () {
    MockClient::global([
        GraphQLRequest::class => MockResponse::fixture('graphql-error'),
    ]);

    $query = <<<'GQL'
query {}
GQL;
    $this->worksome->graph()->execute($query);
})->throws(ClientException::class);
