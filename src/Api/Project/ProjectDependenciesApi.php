<?php

namespace NuToolBox\Gitlab\Api\Project;

use NuToolBox\Gitlab\Api\DependenciesApi;
use NuToolBox\Gitlab\Dto\Dependencies;
use NuToolBox\Gitlab\Exception\GitlabException;

class ProjectDependenciesApi
{
    public function __construct(
        private DependenciesApi $dependenciesApi,
        private int $projectId,
    ) {
    }

    /**
     * @return array<Dependencies>
     * @throws GitlabException
     */
    public function list(): array
    {
        return $this->dependenciesApi->list($this->projectId);
    }
}
