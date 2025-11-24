<?php

declare(strict_types=1);

use Saloon\Http\Faking\MockClient;
use Worksome\Sdk\Worksome;

function worksomeMock(): Worksome
{
    MockClient::destroyGlobal();

    $token = $_SERVER['WORKSOME_API_TOKEN'] ?? 'fake-token';
    $baseUri = $_SERVER['WORKSOME_BASE_URI'] ?? 'https://api.worksome.com';

    return new Worksome($token, $baseUri);
}
