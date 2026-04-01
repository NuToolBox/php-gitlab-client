<?php

namespace NuToolBox\Gitlab\Api;

use NuToolBox\Gitlab\Client;
use NuToolBox\Gitlab\Dto\Branch;
use NuToolBox\Gitlab\Http\GitlabHttpClient;

/**
 * @phpstan-import-type BranchArray from Branch
 */
final readonly class BranchesApi
{
    private GitlabHttpClient $httpClient;

    public function __construct(
        private Client $client
    ) {
        $this->httpClient = $this->client->getHttpClient();
    }

    /**
     * @return list<Branch>
     * @throws \NuToolBox\Gitlab\Exception\GitlabException
     */
    public function list(int|string $projectIdOrPath): array
    {
        $branchList = [];

        /** @var list<BranchArray> $branches */
        $branches = $this
            ->httpClient
            ->getJson('/projects/' . $this->encodeProjectId($projectIdOrPath) . '/repository/branches');

        if (count($branches) > 0) {
            foreach ($branches as $branch) {
                $branchList[] = Branch::fromArray($branch);
            }
        }

        return $branchList;
    }

    private function encodeProjectId(int|string $idOrPath): string
    {
        if (is_int($idOrPath)) {
            return (string) $idOrPath;
        }

        return rawurlencode($idOrPath);
    }
}
