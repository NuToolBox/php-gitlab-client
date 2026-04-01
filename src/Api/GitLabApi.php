<?php

namespace NuToolBox\Gitlab\Api;

use NuToolBox\Gitlab\Client;
use NuToolBox\Gitlab\Http\GitlabHttpClient;

abstract readonly class GitLabApi
{
    private GitlabHttpClient $httpClient;

    public function __construct(
        private Client $client
    ) {
        $this->httpClient = $this->client->getHttpClient();
    }

    public function getHttpClient(): GitlabHttpClient
    {
        return $this->httpClient;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    protected function encodeProjectId(int|string $idOrPath): string
    {
        if (is_int($idOrPath)) {
            return (string) $idOrPath;
        }

        return rawurlencode($idOrPath);
    }
}
