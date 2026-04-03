<?php

namespace NuToolBox\Gitlab\Exception;

final class FeatureNotAvailableException extends GitlabException
{
    public function __construct(
        public readonly string $feature,
        string $message = '',
        ?\Throwable $previous = null
    ) {
        parent::__construct(
            $message ?: sprintf('Feature "%s" is not available.', $feature),
            previous: $previous
        );
    }
}
