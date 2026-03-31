<?php

namespace NuToolBox\Gitlab\Api\Project;

use NuToolBox\Gitlab\Api\BranchesApi;
use NuToolBox\Gitlab\Dto\Branch;

class ProjectBranchesApi
{
    public function __construct(
        private BranchesApi $branchesApi,
        private int $projectId,
    ) {
    }

    /**
     * @return list<Branch>
     */
    public function list(): array
    {
        return $this->branchesApi->list($this->projectId);
    }

//    public function get(string $branchName): Branch
//    {
//        return $this->branchesApi->get($this->projectId, $branchName);
//    }
}
