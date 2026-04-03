<?php

namespace NuToolBox\Gitlab\Tests\Integration;

class DependenciesApiIntegrationTest extends IntegrationTestCase
{
    public function testDependenciesListAgainstRealGitLabAPI(): void
    {
        self::expectException(\NuToolBox\Gitlab\Exception\FeatureNotAvailableException::class);

        $this->getClient()->dependencies()->list('nusphere/symfony-strava-connector');
    }
}
