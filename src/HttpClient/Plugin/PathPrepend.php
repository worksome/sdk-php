<?php

namespace Worksome\Sdk\HttpClient\Plugin;

use Http\Client\Common\Plugin;
use Http\Client\Common\Plugin\VersionBridgePlugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;

final class PathPrepend implements Plugin
{
    use VersionBridgePlugin;

    private string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function doHandleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        $currentPath = $request->getUri()->getPath();
        if (! str_starts_with($currentPath, $this->path)) {
            $uri = $request->getUri()->withPath($this->path . $currentPath);
            $request = $request->withUri($uri);
        }

        return $next($request);
    }
}
