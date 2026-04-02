<?php

namespace NuToolBox\Gitlab\Api\Project;

use NuToolBox\Gitlab\Api\CommitsApi;
use NuToolBox\Gitlab\Dto\Commit;
use NuToolBox\Gitlab\Exception\GitlabException;

/**
 * @phpstan-import-type CommitArray from Commit
 */
final readonly class ProjectCommitsApi
{
    public function __construct(
        private CommitsApi $commitsApi,
        private int $projectId,
    ) {
    }

    /**
     * @return list<Commit>
     * @throws GitlabException
     */
    public function list(): array
    {
        return $this->commitsApi->list($this->projectId);
    }
}
