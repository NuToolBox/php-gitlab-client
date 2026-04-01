<?php

namespace NuToolBox\Gitlab\Tests\Integration;

use NuToolBox\Gitlab\Api\BranchesApi;

class BranchesApiIntegrationTest extends IntegrationTestCase
{
    public function testBranchListAgainstRealGitLabAPI(): void
    {
        $branches = $this->getClient()->branches()->list('nusphere/symfony-strava-connector');

        self::assertNotEmpty($branches);
    }
}
