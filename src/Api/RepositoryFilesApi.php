<?php

namespace NuToolBox\Gitlab\Api;

use NuToolBox\Gitlab\Client;
use NuToolBox\Gitlab\Dto\RepositoryFile;
use NuToolBox\Gitlab\Http\GitlabHttpClient;

/**
 * @phpstan-import-type RepositoryFileArray from RepositoryFile
 */
final readonly class RepositoryFilesApi
{
    private GitlabHttpClient $httpClient;

    public function __construct(
        private Client $client
    ) {
        $this->httpClient = $this->client->getHttpClient();
    }

    public function get(int|string $projectIdOrPath, string $path, string $branchName = 'HEAD'): RepositoryFile
    {
        /** @var RepositoryFileArray $repoFile */
        $repoFile = $this
            ->httpClient
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
            ->httpClient
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
    private function encodeProjectId(int|string $idOrPath): string
    {
        if (is_int($idOrPath)) {
            return (string) $idOrPath;
        }

        return rawurlencode($idOrPath);
    }
}
