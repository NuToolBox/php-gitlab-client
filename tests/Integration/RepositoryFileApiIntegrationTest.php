<?php

namespace NuToolBox\Gitlab\Tests\Integration;

use NuToolBox\Gitlab\Dto\RepositoryFile;

class RepositoryFileApiIntegrationTest extends IntegrationTestCase
{
    public function testRepositoryFileFromRealGitlabApi(): void
    {
        $fileApi = $this->getClient()->files()->get(34169043, 'composer.json');

        self::assertSame('composer.json', $fileApi->fileName);
    }
    public function testRepositoryFileRawFromRealGitlabApi(): void
    {
        $fileRaw = $this->getClient()->files()->getRaw(
            'nusphere/symfony-strava-connector',
            'src/Controller/ConnectController.php'
        );

        self::assertStringContainsString('class ConnectController', $fileRaw);
    }
}
