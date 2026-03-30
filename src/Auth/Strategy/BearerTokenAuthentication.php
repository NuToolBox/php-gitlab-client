<?php

namespace NuToolBox\Gitlab\Auth\Strategy;

use NuToolBox\Gitlab\Api\ProjectsApi;
use NuToolBox\Gitlab\Auth\AuthenticationStrategy;
use Psr\Http\Message\RequestInterface;

final readonly class BearerTokenAuthentication implements AuthenticationStrategy
{
    public const array ALLOWED = [
        ProjectsApi::class
    ];

    public function __construct(private string $token)
    {
    }

    public function authenticate(RequestInterface $request): RequestInterface
    {
        return $request->withHeader('Authorization', 'Bearer ' . $this->token);
    }
}
