<?php

namespace NuToolBox\Gitlab\Api;

use NuToolBox\Gitlab\Dto\Project;
use NuToolBox\Gitlab\Exception\GitlabException;
use NuToolBox\Gitlab\Http\GitlabHttpClient;

/**
 * @phpstan-import-type ProjectArray from Project
 */
final readonly class ProjectsApi
{
    public function __construct(
        private GitlabHttpClient $httpClient
    ) {
    }

    /**
     * @return list<Project>
     * @throws GitlabException
     */
    public function list(int $page = 1, int $perPage = 20, bool $membership = true): array
    {
        $response = $this->httpClient->get('projects', [
            'page' => $page,
            'per_page' => $perPage,
            'membership' => $membership ? 'true' : 'false',
            'simple' => 'true',
        ]);

        /** @var list<ProjectArray> $response */
        return array_map(
            static fn (array $project): Project => Project::fromArray($project),
            $response,
        );
    }
}
