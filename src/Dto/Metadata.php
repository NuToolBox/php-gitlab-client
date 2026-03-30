<?php

namespace NuToolBox\Gitlab\Dto;

/**
 * @phpstan-import-type MetadataKasArray from MetadataKas
 *
 * @phpstan-type MetadataArray array{
 *     version: string,
 *     revision: string,
 *     kas: MetadataKasArray,
 *     enterprise: bool
 * }
 */
readonly class Metadata
{
    public function __construct(
        public string $version,
        public string $revision,
        public MetadataKas $kas,
        public bool $enterprise,
    ) {
    }

    /**
     * @param MetadataArray $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            version: $data['version'],
            revision: $data['revision'],
            kas: new MetadataKas(
                enabled: $data['kas']['enabled'],
                externalUrl: $data['kas']['externalUrl'],
                externalK8sProxyUrl: $data['kas']['externalK8sProxyUrl'],
                version: $data['kas']['version'],
            ),
            enterprise: $data['enterprise']
        );
    }
}
