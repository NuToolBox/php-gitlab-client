<?php

namespace NuToolBox\Gitlab\Api;

use NuToolBox\Gitlab\Dto\Avatar;
use NuToolBox\Gitlab\Http\GitlabHttpClient;

/**
 * @phpstan-import-type AvatarArray from Avatar
 */
final class AvatarApi
{
    public function __construct(
        private GitlabHttpClient $httpClient
    ) {
    }

    public function byEmail(string $publicEmail): Avatar
    {
        /** @var AvatarArray $avatar */
        $avatar = $this->httpClient->get('avatar', [
            'email' => $publicEmail,
        ]);

        $avatar['email'] = $publicEmail;

        return Avatar::fromArray($avatar);
    }
}
