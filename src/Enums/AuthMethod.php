<?php

declare(strict_types=1);

namespace Worksome\Sdk\Enums;

enum AuthMethod: string
{
    case AccessToken = 'access_token_header';
}
