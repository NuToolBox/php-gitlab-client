<?php

namespace NuToolBox\Gitlab\Auth\Strategy;

use NuToolBox\Gitlab\Auth\AuthenticationStrategy;
use Psr\Http\Message\RequestInterface;

final readonly class PrivateTokenAuthentification implements AuthenticationStrategy
{
    public const array ALLOWED = BearerTokenAuthentication::ALLOWED;

    public function __construct(private string $token)
    {
    }

    public function authenticate(RequestInterface $request): RequestInterface
    {
        return $request->withHeader('PRIVATE-TOKEN', $this->token);
    }
}
