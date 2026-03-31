<?php

namespace NuToolBox\Gitlab\Api;

use NuToolBox\Gitlab\Client;
use NuToolBox\Gitlab\Dto\Avatar;
use NuToolBox\Gitlab\Http\GitlabHttpClient;

/**
 * @phpstan-import-type AvatarArray from Avatar
 */
final class AvatarApi
{
    private GitlabHttpClient $httpClient;

    public function __construct(
        private Client $client
    ) {
        $this->httpClient = $this->client->getHttpClient();
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
