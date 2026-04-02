<?php

namespace NuToolBox\Gitlab\Dto;

/**
 * @phpstan-import-type CommitArray from Commit
 *
 * @phpstan-type BranchArray array{
 *     name: string,
 *     merged: bool,
 *     protected: bool,
 *     default: bool,
 *     developers_can_push: bool,
 *     developers_can_merge: bool,
 *     web_url: string,
 *     commit: CommitArray,
 * }
 */
readonly class Branch
{
    public function __construct(
        public string $name,
        public bool $merged,
        public bool $protected,
        public bool $default,
        public bool $developersCanPush,
        public bool $developersCanMerge,
        public string $webUrl,
        public Commit $commit,
    ) {
    }

    /**
     * @param BranchArray $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            merged: $data['merged'],
            protected: $data['protected'],
            default: $data['default'],
            developersCanPush: $data['developers_can_push'],
            developersCanMerge: $data['developers_can_merge'],
            webUrl: $data['web_url'],
            commit: Commit::fromArray($data['commit']),
        );
    }
}
