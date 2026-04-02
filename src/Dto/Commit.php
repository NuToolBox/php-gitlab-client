<?php

namespace NuToolBox\Gitlab\Dto;

use DateTimeImmutable;

/**
 * @phpstan-type CommitArray array{
 *      id: string,
 *      short_id: string,
 *      created_at: string,
 *      parent_ids: string[],
 *      title: string,
 *      message: string,
 *      author_name: string,
 *      author_email: string,
 *      authored_date: string,
 *      committer_name: string,
 *      committed_date: string,
 *      trailers: string[],
 *      extended_trailers: string[],
 *      web_url: string,
 * }
 */
readonly class Commit
{
    /**
     * @param string[] $parentIds
     * @param string[] $trailers
     * @param string[] $extendedTrailers
     */
    public function __construct(
        public string $id,
        public string $shortId,
        public DateTimeImmutable $createdAt,
        public array $parentIds,
        public string $title,
        public string $message,
        public string $authorName,
        public string $authorEmail,
        public DateTimeImmutable $authoredDate,
        public string $committerName,
        public DateTimeImmutable $committedDate,
        public array $trailers,
        public array $extendedTrailers,
        public string $webUrl,
    ) {
    }

    /**
     * @param CommitArray $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            shortId: $data['short_id'],
            createdAt: new DateTimeImmutable($data['created_at']),
            parentIds: $data['parent_ids'],
            title: $data['title'],
            message: $data['message'],
            authorName: $data['author_name'],
            authorEmail: $data['author_email'],
            authoredDate: new DateTimeImmutable($data['authored_date']),
            committerName: $data['committer_name'],
            committedDate: new DateTimeImmutable($data['committed_date']),
            trailers: $data['trailers'],
            extendedTrailers: $data['extended_trailers'],
            webUrl: $data['web_url'],
        );
    }
}
