<?php

namespace NuToolBox\Gitlab\Dto;

use DateTimeImmutable;

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
            defaultBranch: $data['default_branch'],
            archived: $data['archived'] ?? false,
            sshUrlToRepo: $data['ssh_url_to_repo'],
            httpUrlToRepo: $data['http_url_to_repo'],
            webUrl: $data['web_url'],
            readmeUrl: $data['readme_url'],
            forksCount: $data['forks_count'] ?? 0,
            starCount: $data['star_count'] ?? 0,
            avatarUrl: $data['avatar_url'],
            lastActivityAt: new DateTimeImmutable($data['last_activity_at']),
            visibility: $data['visibility'],
        );
    }
}
