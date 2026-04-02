<?php

namespace NuToolBox\Gitlab\Tests\Integration;

class PipelinesApiIntegrationTest extends IntegrationTestCase
{
    public function testPipelinesListAgainstRealGitLabAPI(): void
    {
        $pipelines = $this->getClient()->pipelines()->list('nusphere/wearable.cloud');

        self::assertNotEmpty($pipelines);
    }

    public function testPipelinesListByProjectAgainstRealGitLabAPI(): void
    {
        $project = $this->getClient()->projects()->get('nusphere/wearable.cloud');
        $pipelines = $project->pipelines()->list();

        self::assertNotEmpty($pipelines);
    }
}
