<?php

namespace NuToolBox\Gitlab\Dto;

/**
 * @phpstan-type RepositoryFileArray array{
 *     file_name: string,
 *     file_path: string,
 *     size: int,
 *     encoding: string,
 *     content: string,
 *     content_sha256: string,
 *     ref: string,
 *     blob_id: string,
 *     commit_id: string,
 *     last_commit_id: string,
 *     execute_filemode: bool,
 * }
 */
readonly class RepositoryFile
{
    public function __construct(
        public string $fileName,
        public string $filePath,
        public int $size,
        public string $encoding,
        public string $content,
        public string $content_sha256,
        public string $ref,
        public string $blobId,
        public string $commitId,
        public string $lastCommitId,
        public bool $executeFilemode,
    ) {
    }

    /**
     * @param RepositoryFileArray $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            fileName: $data['file_name'],
            filePath: $data['file_path'],
            size: $data['size'],
            encoding: $data['encoding'],
            content: $data['content'],
            content_sha256: $data['content_sha256'],
            ref: $data['ref'],
            blobId: $data['blob_id'],
            commitId: $data['commit_id'],
            lastCommitId: $data['last_commit_id'],
            executeFilemode: $data['execute_filemode'],
        );
    }
}
