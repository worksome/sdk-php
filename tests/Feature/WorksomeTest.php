<?php

declare(strict_types=1);

use Worksome\Sdk\Resources\GraphQLResource;
use Worksome\Sdk\Resources\ViewerResource;
use Worksome\Sdk\Worksome;

it('gets instances from the client', function () {
    $client = new Worksome('test-key');

    // Retrieves GraphQL instance
    expect($client->graph())->toBeInstanceOf(GraphQLResource::class)
        ->and($client->graphql())->toBeInstanceOf(GraphQLResource::class)
        ->and($client->viewer())->toBeInstanceOf(ViewerResource::class);
});
