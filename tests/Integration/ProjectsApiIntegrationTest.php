<?php

namespace NuToolBox\Gitlab\Tests\Integration;

use DateMalformedStringException;
use Http\Discovery\Psr17Factory;
use Http\Discovery\Psr18Client;
use NuToolBox\Gitlab\Api\Project\ProjectResource;
use NuToolBox\Gitlab\Auth\GitlabAuthentication;
use NuToolBox\Gitlab\Client;
use NuToolBox\Gitlab\Dto\Project;
use NuToolBox\Gitlab\Exception\GitlabException;
use NuToolBox\Gitlab\Exception\NotFoundException;
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
            ProjectResource::class,
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
            ProjectResource::class,
            $projects
        );
    }

    /**
     * @throws GitlabException
     */
    public function testGetNoProjectAgainstRealGitlabApi(): void
    {
        self::expectException(NotFoundException::class);
        self::expectExceptionMessage('404 Project Not Found');

        $this->getClient()->projects()->get(12);
    }



    /**
     * @throws GitlabException
     */
    public function testGetProjectAgainstRealGitlabApi(): void
    {
        $project = $this->getClient()->projects()->get(16925924);

        self::assertSame(16925924, $project->details()->id);
    }

    /**
     * @throws GitlabException
     */
    public function testGetProjectBranchesAgainstRealGitlabApi(): void
    {
        $project = $this->getClient()->projects()->get(20535049);

        self::assertNotEmpty($project->branches()->list());
    }

    /**
     * @throws GitlabException
     */
    public function testGetProjectAgainstGitlabApiMockup(): void
    {
        $project = $this->getMockedClient('gitlab/projects/get_success.json')
            ->projects()->get(16925924);

        self::assertSame(16925924, $project->details()->id);
    }
}
