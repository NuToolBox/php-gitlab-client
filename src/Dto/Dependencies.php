<?php

namespace NuToolBox\Gitlab\Dto;

/**
 * @phpstan-type DependenciesArray array{
 *     name: string,
 *     version: string,
 *     package_manager: string,
 *     dependency_file_path: string,
 *     vulnerabilities: array{
 *          name: string,
 *          severity: string,
 *          id: string,
 *          url: string,
 *     },
 *     licenses: array{
 *          name: string,
 *          url: string,
 *     },
 * }
 */
readonly class Dependencies
{
    /**
     * @param array{name: string, severity: string, id: string, url: string} $vulnerabilities
     * @param array{name: string, url: string} $licenses
     */
    public function __construct(
        public string $name,
        public string $version,
        public string $packageManager,
        public string $dependencyFilePath,
        public array $vulnerabilities,
        public array $licenses,
    ) {
    }

    /**
     * @param DependenciesArray $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            version: $data['version'],
            packageManager: $data['package_manager'],
            dependencyFilePath: $data['dependency_file_path'],
            vulnerabilities: $data['vulnerabilities'],
            licenses: $data['licenses'],
        );
    }
}
