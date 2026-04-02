<?php

namespace NuToolBox\Gitlab\Api\Project;

use NuToolBox\Gitlab\Api\PipelinesApi;
use NuToolBox\Gitlab\Dto\Pipeline;
use NuToolBox\Gitlab\Exception\GitlabException;

final readonly class ProjectPipelinesApi
{
    public function __construct(
        private PipelinesApi $pipelinesApi,
        private int $projectId,
    ) {
    }

    /**
     * @return list<Pipeline>
     * @throws GitlabException
     */
    public function list(): array
    {
        return $this->pipelinesApi->list($this->projectId);
    }
}
