<?php

namespace NuToolBox\Gitlab\Dto;

use DateTimeImmutable;

/**
 * @phpstan-type ProjectArray array{
 *       id: int,
 *       description: string,
 *       name: string,
 *       name_with_namespace: string,
 *       path: string,
 *       path_with_namespace: string,
 *       created_at: "2020-02-15T13:54:28.061Z",
 *       default_branch: string,
 *       ssh_url_to_repo: string,
 *       http_url_to_repo: string,
 *       web_url: string,
 *       readme_url: string,
 *       forks_count: int,
 *       avatar_url: string,
 *       star_count: int<0, max>,
 *       last_activity_at: string,
 *       visibility: string,
 *       archived?: bool,
 *  }
 */
readonly class Project
{
    public function __construct(
        public int $id,
        public string $description,
        public string $name,
        public string $nameWithNamespace,
        public string $path,
        public string $pathWithNamespace,
        public DateTimeImmutable $createdAt,
        public DateTimeImmutable $lastActivityAt,
        public string $defaultBranch,
        public bool $archived,
        public string $sshUrlToRepo,
        public string $httpUrlToRepo,
        public string $webUrl,
        public ?string $readmeUrl,
        public ?string $avatarUrl,
        public string $visibility,
        public int $forksCount = 0,
        public int $starCount = 0,
    ) {
    }

    /**
     * @param ProjectArray $data
     * @return self
     * @throws \DateMalformedStringException
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            description: $data['description'],
            name: $data['name'],
            nameWithNamespace: $data['name_with_namespace'],
            path: $data['path'],
            pathWithNamespace: $data['path_with_namespace'],
            createdAt: new DateTimeImmutable($data['created_at']),
            lastActivityAt: new DateTimeImmutable($data['last_activity_at']),
            defaultBranch: $data['default_branch'],
            archived: $data['archived'] ?? false,
            sshUrlToRepo: $data['ssh_url_to_repo'],
            httpUrlToRepo: $data['http_url_to_repo'],
            webUrl: $data['web_url'],
            readmeUrl: $data['readme_url'],
            avatarUrl: $data['avatar_url'],
            visibility: $data['visibility'],
            forksCount: $data['forks_count'],
            starCount: $data['star_count'],
        );
    }
}
