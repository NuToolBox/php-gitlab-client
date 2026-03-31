<?php

namespace NuToolBox\Gitlab\Dto;

/**
 * @phpstan-type BranchArray array{
 *     name: string,
 *     default: bool,
 *     size?: int
 * }
 */
class Branch
{
    public function __construct(
        public string $name,
        public bool $default,
    ) {
    }

    /**
     * @param BranchArray $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            default: $data['default'],
        );
    }
}
