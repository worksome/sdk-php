<?php

declare(strict_types=1);

use Worksome\Sdk\Api\GraphQL;
use Worksome\Sdk\Api\Viewer;
use Worksome\Sdk\Client;

it('gets instances from the client', function () {
    $client = new Client();

    // Retrieves GraphQL instance
    expect($client->graph())->toBeInstanceOf(GraphQL::class)
        ->and($client->graphql())->toBeInstanceOf(GraphQL::class)
        ->and($client->viewer())->toBeInstanceOf(Viewer::class);
});
