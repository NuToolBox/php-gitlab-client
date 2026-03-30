<?php

namespace NuToolBox\Gitlab\Tests\Integration;

use Http\Discovery\Psr17Factory;
use Http\Discovery\Psr18Client;
use NuToolBox\Gitlab\Auth\GitlabAuthentication;
use NuToolBox\Gitlab\Client;
use NuToolBox\Gitlab\Tests\Support\Fixtures;
use NuToolBox\Gitlab\Tests\Support\Http\MockHttpClient;
use PHPUnit\Framework\TestCase;

abstract class IntegrationTestCase extends TestCase
{
    public function getClient(): Client
    {
        $baseUrl = $_ENV['GITLAB_BASE_URL'] ?: '';
        $token = $_ENV['GITLAB_TOKEN'] ?: '';

        if ($baseUrl === '' || $token === '' || !is_string($token) || !is_string($baseUrl)) {
            self::markTestSkipped('GITLAB_BASE_URL or GITLAB_TOKEN is not configured.');
        }

        return new Client(
            psrHttpClient: new Psr18Client(),
            requestFactory: new Psr17Factory(),
            authentication: GitlabAuthentication::privateToken($token),
            baseUrl: $baseUrl,
        );
    }

    public function getMockedClient(string $fixtureJsonPath): Client
    {
        $json = Fixtures::load($fixtureJsonPath);

        $factory = new Psr17Factory();

        $response = $factory->createResponse(200)
            ->withHeader('Content-Type', 'application/json');

        $response->getBody()->write($json);

        $mockHttpClient = new MockHttpClient($response);

        return new Client(
            psrHttpClient: $mockHttpClient,
            requestFactory: $factory,
            authentication: GitlabAuthentication::privateToken('gitlab-private-token'),
            baseUrl: 'https://gitlab.example.com',
        );
    }
}
