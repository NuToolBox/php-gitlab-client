<?php

namespace NuToolBox\Gitlab\Api;

use NuToolBox\Gitlab\Client;
use NuToolBox\Gitlab\Dto\Metadata;
use NuToolBox\Gitlab\Exception\GitlabException;
use NuToolBox\Gitlab\Http\GitlabHttpClient;

/**
 * https://docs.gitlab.com/api/metadata/
 *
 * @phpstan-import-type MetadataArray from Metadata
 */
final readonly class MetadataApi
{
    private GitlabHttpClient $httpClient;

    public function __construct(
        private Client $client
    ) {
        $this->httpClient = $this->client->getHttpClient();
    }

    /**
     * @throws GitlabException
     */
    public function version(): Metadata
    {
        /** @var MetadataArray $response */
        $response = $this->httpClient->get('version');

        return Metadata::fromArray($response);
    }

    public function metadata(): Metadata
    {
        /** @var MetadataArray $response */
        $response = $this->httpClient->get('metadata');

        return Metadata::fromArray($response);
    }
}
