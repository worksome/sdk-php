<?php

declare(strict_types=1);

use Worksome\Sdk\Api\Viewer;

beforeEach(fn () => $this->apiClass = Viewer::class);

it('can query the id for a viewer', function () {
    /** @var Viewer $api */
    $api = $this->getApi();

    expect($api->id())->toBe('VXNlcjox');
});

it('can query the accounts for a viewer', function () {
    /** @var Viewer $api */
    $api = $this->getApi();

    expect($api->accounts())->toBe([
        [
            'id' => 'Q29tcGFueTox',
            'name' => 'Test Company'
        ]
    ]);
});

it('can change email for the viewer', function () {
    /** @var Viewer $api */
    $api = $this->getApi();

    expect($api->changeEmail('test@test.com'))->toBe([
        'id' => 'VXNlcjox',
        'email' => 'test@test.com'
    ]);
});

it('can send a verification email for the viewer', function () {
    /** @var Viewer $api */
    $api = $this->getApi();

    expect($api->sendVerificationEmail())->toBe([
        'id' => 'VXNlcjox',
        'email' => 'test@test.com'
    ]);
});
