<?php

namespace NuToolBox\Gitlab\Tests\Integration;

use NuToolBox\Gitlab\Api\AvatarApi;

class AvatarIntegrationTest extends IntegrationTestCase
{
    public function testAvatarApiAgainstRealGitlabApi(): void
    {
        $avatar = $this->getClient()->avatar()->byEmail('nusphere83@gmail.com');

        $this->assertStringContainsString('gravatar', $avatar->avatarUrl);
        $this->assertSame('nusphere83@gmail.com', $avatar->email);
    }
}
