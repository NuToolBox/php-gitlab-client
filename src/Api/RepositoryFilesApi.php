<?php

namespace NuToolBox\Gitlab\Api;

use NuToolBox\Gitlab\Dto\RepositoryFile;

/**
 * @phpstan-import-type RepositoryFileArray from RepositoryFile
 */
final readonly class RepositoryFilesApi extends GitLabApi
{
    public function get(int|string $projectIdOrPath, string $path, string $branchName = 'HEAD'): RepositoryFile
    {
        /** @var RepositoryFileArray $repoFile */
        $repoFile = $this
            ->getHttpClient()
            ->getJson(
                '/projects/' . $this->encodeProjectId($projectIdOrPath) . '/repository/files/' . $path,
                [
                    'ref' => $branchName
                ]
            );

        return RepositoryFile::fromArray($repoFile);
    }

    public function getRaw(int|string $projectIdOrPath, string $path, string $branchName = 'HEAD'): string
    {
        /** @var string $repoFileRaw */
        $repoFileRaw = $this
            ->getHttpClient()
            ->get(
                vsprintf(
                    '/projects/%s/repository/files/%s/raw',
                    [
                        $this->encodeProjectId($projectIdOrPath),
                        rawurlencode($path)
                    ]
                ),
                [
                    'ref' => $branchName
                ]
            );

        return $repoFileRaw;
    }
}
