<?php

namespace NuToolBox\Gitlab\Dto;

/**
 * @phpstan-type AvatarArray array{
 *     email: string,
 *     avatar_url: string,
 *     size?: int
 * }
 */
readonly class Avatar
{
    public function __construct(
        public string $email,
        public string $avatarUrl,
        public ?int $size,
    ) {
    }

    /**
     * @param AvatarArray $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            email: $data['email'],
            avatarUrl: $data['avatar_url'],
            size: $data['size'] ?? null,
        );
    }
}
