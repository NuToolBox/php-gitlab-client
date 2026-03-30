<?php

namespace NuToolBox\Gitlab\Tests\Support;

final class Fixtures
{
    public static function load(string $relativePath): string
    {
        $path = __DIR__ . '/../Fixtures/' . ltrim($relativePath, '/');

        if (!is_file($path)) {
            throw new \RuntimeException(sprintf('Fixture file not found: %s', $path));
        }

        $contents = file_get_contents($path);

        if ($contents === false) {
            throw new \RuntimeException(sprintf('Fixture file could not be read: %s', $path));
        }

        return $contents;
    }
}
