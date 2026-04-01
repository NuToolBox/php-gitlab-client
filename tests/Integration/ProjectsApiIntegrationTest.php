<?php

namespace NuToolBox\Gitlab\Tests\Integration;

use DateMalformedStringException;
use NuToolBox\Gitlab\Api\Project\ProjectResource;
use NuToolBox\Gitlab\Exception\GitlabException;
use NuToolBox\Gitlab\Exception\NotFoundException;
use PHPUnit\Framework\Attributes\Group;

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
    public function testGetProjectDetailsAgainstRealGitlabApi(): void
    {
        $projectDetails = $this->getClient()->projects()->fetchDetails('nusphere/symfony-strava-connector');

        self::assertSame(34169043, $projectDetails->id);
    }

    /**
     * @throws GitlabException
     */
    public function testGetProjectFileAgainstRealGitlabApi(): void
    {
        $project = $this->getClient()->projects()->get('nusphere/symfony-strava-connector');

        self::assertSame('composer.json', $project->files()->get('composer.json')->fileName);
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
