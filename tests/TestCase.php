<?php

namespace Worksome\Sdk\Tests;

use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Client\Plugin\Vcr\NamingStrategy\PathNamingStrategy;
use Http\Client\Plugin\Vcr\Recorder\FilesystemRecorder;
use Http\Client\Plugin\Vcr\RecordPlugin;
use Http\Client\Plugin\Vcr\ReplayPlugin;
use Http\Discovery\Psr17FactoryDiscovery;
use Worksome\Sdk\Api\AbstractApi;
use Worksome\Sdk\Client;
use Worksome\Sdk\HttpClient\Builder;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    /** @var class-string<AbstractApi> */
    protected string $apiClass;

    protected function getApi(): AbstractApi
    {
        $namingStrategy = new PathNamingStrategy();
        $recorder = new FilesystemRecorder(__DIR__ . '/__SNAPSHOTS__');

        $httpBuilder = new Builder();
        $httpBuilder->addPlugin(
            in_array('--update-snapshots', $_SERVER['argv']) || getenv('UPDATE_SNAPSHOTS') === 'true' ?
                new RecordPlugin($namingStrategy, $recorder) :
                new ReplayPlugin($namingStrategy, $recorder)
        );

        $client = new Client($httpBuilder);

        $httpBuilder->removePlugin(AddHostPlugin::class);
        $httpBuilder->addPlugin(
            new AddHostPlugin(Psr17FactoryDiscovery::findUriFactory()->createUri(
                (string) (getenv('WORKSOME_LOCAL_API_URL') ?: 'http://localhost:3000')
            ))
        );

        $client->authenticate((string) getenv('WORKSOME_LOCAL_API_TOKEN'));

        return new ($this->apiClass)($client);
    }
}
