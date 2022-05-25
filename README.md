# Worksome PHP SDK

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-github-actions]][link-github-actions]
[![Static Analysis Status][ico-static-analysis]][link-static-analysis]
[![Total Downloads][ico-downloads]][link-downloads]

An object-oriented PHP wrapper for the Worksome API

## Requirements

- PHP >= 8.1
- A [PSR-17 implementation](https://packagist.org/providers/psr/http-factory-implementation)
- A [PSR-18 implementation](https://packagist.org/providers/psr/http-client-implementation)

## Install

Via Composer

```shell
composer require worksome/sdk guzzlehttp/guzzle:^7.5 http-interop/http-factory-guzzle:^1.2
```

We are decoupled from any HTTP messaging client with help by [HTTPlug](https://httplug.io).

## Usage

**Basic usage**

```php
// Include the Composer autoloader
require_once __DIR__ . '/vendor/autoload.php';

$client = new \Worksome\Sdk\Client();
$repositories = $client->graph()->query(<<<GQL
    query {
        profile {
            name
            email
        }
    }
>>>);
```

**Authentication**

```php
use Worksome\Sdk\Client;
$client = new Client();
$client->authenticate($apiToken);
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

```shell
composer test
```

## Credits

- [Owen Voke][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/worksome/sdk.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-github-actions]: https://img.shields.io/github/workflow/status/worksome/sdk-php/Tests.svg?style=flat-square
[ico-static-analysis]: https://img.shields.io/github/workflow/status/worksome/sdk-php/Static%20Analysis?label=static%20analysis&style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/worksome/sdk.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/worksome/sdk
[link-github-actions]: https://github.com/worksome/sdk-php/actions
[link-static-analysis]: https://github.com/worksome/sdk-php/actions?query=workflow%3AStatic%20Analysis
[link-downloads]: https://packagist.org/packages/worksome/sdk
[link-author]: https://github.com/owenvoke
[link-contributors]: ../../contributors