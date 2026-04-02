<?php

namespace NuToolBox\Gitlab\Api;

use NuToolBox\Gitlab\Dto\Commit;
use NuToolBox\Gitlab\Exception\GitlabException;

/**
 * @phpstan-import-type CommitArray from Commit
 */
final readonly class CommitsApi extends GitLabApi
{
    /**
     * @return list<Commit>
     * @throws GitlabException
     */
    public function list(int|string $projectIdOrPath): array
    {
        $commitList = [];

        /** @var list<CommitArray> $commits */
        $commits = $this
            ->getHttpClient()
            ->getJson('/projects/' . $this->encodeProjectId($projectIdOrPath) . '/repository/commits');

        if (count($commits) > 0) {
            foreach ($commits as $commit) {
                $commitList[] = Commit::fromArray($commit);
            }
        }

        return $commitList;
    }
}
