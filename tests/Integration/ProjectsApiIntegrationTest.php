<?php

namespace NuToolBox\Gitlab\Tests\Integration;

use Http\Discovery\Psr17Factory;
use NuToolBox\Gitlab\Auth\GitlabAuthentication;
use NuToolBox\Gitlab\Client;
use NuToolBox\Gitlab\Dto\Project;
use NuToolBox\Gitlab\Tests\Support\Fixtures;
use NuToolBox\Gitlab\Tests\Support\Http\MockHttpClient;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[Group('integration')]
final class ProjectsApiIntegrationTest extends TestCase
{
    public function testListProjectsAgainstRealGitlabApi(): void
    {
        $json = Fixtures::load('gitlab/projects/list_success.json');

        $factory = new Psr17Factory();

        $response = $factory->createResponse(200)
            ->withHeader('Content-Type', 'application/json');

        $response->getBody()->write($json);

        $mockHttpClient = new MockHttpClient($response);

        $client = new Client(
            psrHttpClient: $mockHttpClient,
            requestFactory: $factory,
            authentication: GitlabAuthentication::privateToken('glpat-test'),
            baseUrl: 'https://gitlab.example.com',
        );

        $projects = $client->projects()->list();

        self::assertIsArray($projects);
        self::assertNotEmpty($projects, 'Expected at least one project from the GitLab API.');
        self::assertContainsOnlyInstancesOf(
            Project::class,
            $projects
        );
    }
}
