<?php

namespace NuToolBox\Gitlab\Dto;

/**
 * @phpstan-type MetadataKasArray array{
 *     enabled: bool,
 *     externalUrl: string,
 *     externalK8sProxyUrl: string,
 *     version: string
 * }
 */
readonly class MetadataKas
{
    public function __construct(
        public bool $enabled,
        public string $externalUrl,
        public string $externalK8sProxyUrl,
        public string $version,
    ) {
    }

    /**
     * @param MetadataKasArray $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            enabled: $data['enabled'],
            externalUrl: $data['externalUrl'],
            externalK8sProxyUrl: $data['externalK8sProxyUrl'],
            version: $data['version']
        );
    }
}
