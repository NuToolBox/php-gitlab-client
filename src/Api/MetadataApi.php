<?php

namespace NuToolBox\Gitlab\Api;

use NuToolBox\Gitlab\Dto\Metadata;
use NuToolBox\Gitlab\Exception\GitlabException;

/**
 * https://docs.gitlab.com/api/metadata/
 *
 * @phpstan-import-type MetadataArray from Metadata
 */
final readonly class MetadataApi extends GitLabApi
{
    /**
     * @throws GitlabException
     */
    public function version(): Metadata
    {
        /** @var MetadataArray $response */
        $response = $this->getHttpClient()->getJson('version');

        return Metadata::fromArray($response);
    }

    public function metadata(): Metadata
    {
        /** @var MetadataArray $response */
        $response = $this->getHttpClient()->getJson('metadata');

        return Metadata::fromArray($response);
    }
}
