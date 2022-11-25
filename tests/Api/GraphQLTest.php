<?php

declare(strict_types=1);

use Worksome\Sdk\Api\GraphQL;

beforeEach(fn () => $this->apiClass = GraphQL::class);

it('can query via the Graph API', function () {
    $query = <<<'GQL'
query {
  profile {
    id
    email
  }
}
GQL;
    /** @var GraphQL $api */
    $api = $this->getApi();

    expect($api->execute($query))
        ->data->toBeArray()
        ->data->profile->toBeArray()
        ->data->profile->id->toBe('VXNlcjox')
        ->data->profile->email->toBe('admin@worksome.test');
});
