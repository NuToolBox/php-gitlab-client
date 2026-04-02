<?php

namespace NuToolBox\Gitlab\Tests\Integration;

use NuToolBox\Gitlab\Exception\GitlabException;

final class BranchesApiIntegrationTest extends IntegrationTestCase
{
    /**
     * @throws GitlabException
     */
    public function testBranchListAgainstRealGitLabAPI(): void
    {
        $branches = $this->getClient()->branches()->list('nusphere/symfony-strava-connector');

        self::assertNotEmpty($branches);
        self::assertStringContainsString('nusphere/symfony-strava-connector', $branches[0]->webUrl);
        self::assertSame('master', $branches[0]->name);
    }
}
