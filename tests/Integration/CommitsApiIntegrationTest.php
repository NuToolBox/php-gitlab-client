<?php

namespace NuToolBox\Gitlab\Tests\Integration;

use NuToolBox\Gitlab\Exception\GitlabException;

class CommitsApiIntegrationTest extends IntegrationTestCase
{
    /**
     * @throws GitlabException
     */
    public function testCommitListAgainstRealGitLabAPI(): void
    {
        $commits = $this->getClient()->commits()->list('nusphere/symfony-strava-connector');

        self::assertNotEmpty($commits);
        self::assertStringContainsString('nusphere/symfony-strava-connector', $commits[0]->webUrl);
    }

    /**
     * @throws GitlabException
     */
    public function testCommitListByProjectAgainstRealGitLabAPI(): void
    {
        $project = $this->getClient()->projects()->get('nusphere/symfony-strava-connector');
        $commits = $project->commits()->list();

        self::assertNotEmpty($commits);
        self::assertStringContainsString('nusphere/symfony-strava-connector', $commits[0]->webUrl);
    }
}
