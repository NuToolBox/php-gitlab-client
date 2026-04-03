<?php

namespace NuToolBox\Gitlab\Tests\Integration;

use NuToolBox\Gitlab\Exception\GitlabException;

final class MetadataApiIntegrationTest extends IntegrationTestCase
{
    /**
     * @throws GitlabException
     */
    public function testVersionApiAgainstRealGitlabApi(): void
    {
        $version = $this->getClient()->metadata()->version();
        $metadata = $this->getClient()->metadata()->metadata();

        self::assertObjectHasProperty('version', $version);
        self::assertObjectHasProperty('version', $metadata);
    }
}
