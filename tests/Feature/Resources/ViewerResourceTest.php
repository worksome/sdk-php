<?php

declare(strict_types=1);

use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Worksome\Sdk\Requests\GraphQLRequest;

beforeEach(function () {
    $this->worksome = worksomeMock();
});

it('can query the id for a viewer', function () {
    MockClient::global([
        GraphQLRequest::class => MockResponse::fixture('viewer-id'),
    ]);

    expect($this->worksome->viewer()->id())
        ->toBe('VXNlcjox');
});

it('can query the accounts for a viewer', function () {
    MockClient::global([
        GraphQLRequest::class => MockResponse::fixture('viewer-accounts'),
    ]);

    expect($this->worksome->viewer()->accounts())->toBe([
        [
            'id' => 'Q29tcGFueTox',
            'name' => 'Test Company',
        ],
    ]);
});

it('can change email for the viewer', function () {
    MockClient::global([
        GraphQLRequest::class => MockResponse::fixture('viewer-change-email'),
    ]);

    expect($this->worksome->viewer()->changeEmail('test@test.com'))->toBe([
        'id' => 'VXNlcjox',
        'email' => 'test@test.com',
    ]);
});

it('can send a verification email for the viewer', function () {
    MockClient::global([
        GraphQLRequest::class => MockResponse::fixture('viewer-send-verification-email'),
    ]);

    expect($this->worksome->viewer()->sendVerificationEmail())->toBe([
        'id' => 'VXNlcjox',
        'email' => 'test@test.com',
    ]);
});
