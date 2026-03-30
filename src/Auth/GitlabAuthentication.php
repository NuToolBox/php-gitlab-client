<?php

namespace NuToolBox\Gitlab\Auth;

use InvalidArgumentException;
use NuToolBox\Gitlab\Auth\Strategy as Strategy;

final readonly class GitlabAuthentication
{
    public static function privateToken(string $token): AuthenticationStrategy
    {
        self::assertNotEmpty($token, 'token');

        return new Strategy\PrivateTokenAuthentification(token: $token);
    }

    public static function bearer(string $token): AuthenticationStrategy
    {
        self::assertNotEmpty($token, 'token');

        return new Strategy\BearerTokenAuthentication(token: $token);
    }

    public static function jobToken(string $token): AuthenticationStrategy
    {
        self::assertNotEmpty($token, 'token');

        return new Strategy\JobTokenAuthentication(token: $token);
    }

    private static function assertNotEmpty(string $value, string $name): void
    {
        if (trim($value) === '') {
            throw new InvalidArgumentException(sprintf('The "%s" value must not be empty.', $name));
        }
    }
}
