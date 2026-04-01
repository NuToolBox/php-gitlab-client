<?php

namespace NuToolBox\Gitlab\Api;

use NuToolBox\Gitlab\Dto\Avatar;

/**
 * @phpstan-import-type AvatarArray from Avatar
 */
final readonly class AvatarApi extends GitLabApi
{
    public function byEmail(string $publicEmail): Avatar
    {
        /** @var AvatarArray $avatar */
        $avatar = $this->getHttpClient()->getJson('avatar', [
            'email' => $publicEmail,
        ]);

        $avatar['email'] = $publicEmail;

        return Avatar::fromArray($avatar);
    }
}
