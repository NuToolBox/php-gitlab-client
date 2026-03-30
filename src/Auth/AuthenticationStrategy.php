<?php

namespace NuToolBox\Gitlab\Auth;

use Psr\Http\Message\RequestInterface;

interface AuthenticationStrategy
{
    public function authenticate(RequestInterface $request): RequestInterface;
}
