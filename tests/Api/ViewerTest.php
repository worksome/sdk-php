<?php

declare(strict_types=1);

use Worksome\Sdk\Api\Viewer;

beforeEach(fn () => $this->apiClass = Viewer::class);

it('can query the id for a viewer', function () {
    $query = <<<'GQL'
query {
  profile {
    id
    email
  }
}
GQL;
    /** @var Viewer $api */
    $api = $this->getApi();

    expect($api->id())->toBe('VXNlcjox');
});

it('can query the accounts for a viewer', function () {
    $query = <<<'GQL'
query {
  profile {
    id
    email
  }
}
GQL;
    /** @var Viewer $api */
    $api = $this->getApi();

    expect($api->accounts())->toBe([
        [
            'id' => 'Q29tcGFueTox',
            'name' => 'Test Company'
        ]
    ]);
});
