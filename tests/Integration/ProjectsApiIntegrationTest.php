<?php

namespace NuToolBox\Gitlab\Tests\Integration;

use DateMalformedStringException;
use Http\Discovery\Psr17Factory;
use Http\Discovery\Psr18Client;
use NuToolBox\Gitlab\Auth\GitlabAuthentication;
use NuToolBox\Gitlab\Client;
use NuToolBox\Gitlab\Dto\Project;
use NuToolBox\Gitlab\Exception\GitlabException;
use NuToolBox\Gitlab\Tests\Support\Fixtures;
use NuToolBox\Gitlab\Tests\Support\Http\MockHttpClient;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[Group('integration')]
final class ProjectsApiIntegrationTest extends IntegrationTestCase
{
    /**
     * @throws GitlabException
     */
    public function testListProjectsAgainstRealGitlabApi(): void
    {
        $projects = $this->getClient()->projects()->list();

        self::assertNotEmpty($projects, 'Expected at least one project from the GitLab API.');
        self::assertContainsOnlyInstancesOf(
            Project::class,
            $projects
        );
    }

    /**
     * @throws GitlabException
     * @throws DateMalformedStringException
     */
    public function testListProjectsAgainstGitlabApiFixture(): void
    {
        $projects = $this->getMockedClient('gitlab/projects/list_success.json')
            ->projects()->list();

        self::assertNotEmpty($projects, 'Expected at least one project from the GitLab API.');
        self::assertContainsOnlyInstancesOf(
            Project::class,
            $projects
        );
    }
}
