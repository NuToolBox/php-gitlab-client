<?php

namespace NuToolBox\Gitlab\Dto;

use DateTimeImmutable;

/**
 * @phpstan-type PipelineArray array{
 *     id: int,
 *     iid: int,
 *     project_id: int,
 *     status: string,
 *     source: string,
 *     ref: string,
 *     sha: string,
 *     name?: string,
 *     web_url: string,
 *     created_at: string,
 *     updated_at: string
 * }
 */
readonly class Pipeline
{
    public function __construct(
        public int $id,
        public int $iid,
        public int $projectId,
        public string $status,
        public string $source,
        public string $ref,
        public string $sha,
        public ?string $name,
        public string $webUrl,
        public DateTimeImmutable $createdAt,
        public DateTimeImmutable $updatedAt,
    ) {
    }

    /**
     * @param PipelineArray $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            iid: $data['iid'],
            projectId: $data['project_id'],
            status: $data['status'],
            source: $data['source'],
            ref: $data['ref'],
            sha: $data['sha'],
            name: $data['name'] ?? null,
            webUrl: $data['web_url'],
            createdAt: new DateTimeImmutable($data['created_at']),
            updatedAt: new DateTimeImmutable($data['updated_at']),
        );
    }
}
