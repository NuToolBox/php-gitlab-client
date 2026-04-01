<?php

namespace NuToolBox\Gitlab\Api\Project;

use NuToolBox\Gitlab\Api\RepositoryFilesApi;
use NuToolBox\Gitlab\Dto\RepositoryFile;

final readonly class ProjectRepositoryFilesApi
{
    public function __construct(
        private RepositoryFilesApi $repositoryFilesApi,
        private int $projectId,
    ) {
    }

    public function getRaw(string $path, string $branchName = 'HEAD'): string
    {
        return $this->repositoryFilesApi->getRaw($this->projectId, $path, $branchName);
    }

    public function get(string $path, string $branchName = 'HEAD'): RepositoryFile
    {
        return $this->repositoryFilesApi->get($this->projectId, $path, $branchName);
    }
}
