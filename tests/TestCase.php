<?php

namespace Worksome\Sdk\Tests;

use PHPUnit\Framework\MockObject\MockObject;
use Psr\Http\Client\ClientInterface;
use Worksome\Sdk\Client;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    /** @var class-string */
    protected string $apiClass;

    protected function getApiMock(): MockObject
    {
        $httpClient = $this->getMockBuilder(ClientInterface::class)
            ->onlyMethods(['sendRequest'])
            ->getMock();

        $httpClient
            ->expects($this->any())
            ->method('sendRequest');

        $client = Client::createWithHttpClient($httpClient);

        return $this->getMockBuilder($this->apiClass)
            ->onlyMethods(['get', 'post', 'postRaw', 'patch', 'delete', 'put', 'head', 'query'])
            ->setConstructorArgs([$client])
            ->getMock();
    }
}
