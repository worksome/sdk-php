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

    $response = [
        'data' => [
            'profile' => [
                'id' => 'VXNlcjox',
                'email' => 'user@worksome.test'
            ]
        ]
    ];

    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('query')
        ->with($query)
        ->willReturn($response);

    /** @var GraphQL $api */
    expect($api->query($query))->toBe($response);
});
