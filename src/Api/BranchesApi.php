<?php

namespace NuToolBox\Gitlab\Api;

use NuToolBox\Gitlab\Dto\Branch;
use NuToolBox\Gitlab\Exception\GitlabException;

/**
 * @phpstan-import-type BranchArray from Branch
 */
final readonly class BranchesApi extends GitLabApi
{
    /**
     * @return list<Branch>
     * @throws GitlabException
     */
    public function list(int|string $projectIdOrPath): array
    {
        $branchList = [];

        /** @var list<BranchArray> $branches */
        $branches = $this
            ->getHttpClient()
            ->getJson('/projects/' . $this->encodeProjectId($projectIdOrPath) . '/repository/branches');

        if (count($branches) > 0) {
            foreach ($branches as $branch) {
                $branchList[] = Branch::fromArray($branch);
            }
        }

        return $branchList;
    }
}
