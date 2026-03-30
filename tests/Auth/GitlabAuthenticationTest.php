<?php

namespace NuToolBox\Gitlab\Tests\Auth;

use Http\Discovery\Psr17Factory;
use NuToolBox\Gitlab\Auth\GitlabAuthentication;
use PHPUnit\Framework\TestCase;

final class GitlabAuthenticationTest extends TestCase
{
    public function testPrivateTokenAuthenticationSetsHeader(): void
    {
        $factory = new Psr17Factory();
        $request = $factory->createRequest('GET', 'https://example.com');

        $authenticatedRequest = GitlabAuthentication::privateToken('glpat-test')
            ->authenticate($request);

        self::assertSame(
            ['glpat-test'],
            $authenticatedRequest->getHeader('PRIVATE-TOKEN')
        );
    }

    public function testBearerAuthenticationSetsHeader(): void
    {
        $factory = new Psr17Factory();
        $request = $factory->createRequest('GET', 'https://example.com');

        $authenticatedRequest = GitlabAuthentication::bearer('token-123')
            ->authenticate($request);

        self::assertSame(
            ['Bearer token-123'],
            $authenticatedRequest->getHeader('Authorization')
        );
    }

    public function testJobTokenAuthenticationSetsHeader(): void
    {
        $factory = new Psr17Factory();
        $request = $factory->createRequest('GET', 'https://example.com');

        $authenticatedRequest = GitlabAuthentication::jobToken('job-token')
            ->authenticate($request);

        self::assertSame(
            ['job-token'],
            $authenticatedRequest->getHeader('JOB-TOKEN')
        );
    }
}
