<?php

namespace NuToolBox\Gitlab\Api;

use DateMalformedStringException;
use NuToolBox\Gitlab\Api\Project\ProjectResource;
use NuToolBox\Gitlab\Dto\Project;
use NuToolBox\Gitlab\Exception\GitlabException;

/**
 * @phpstan-import-type ProjectArray from Project
 */
final readonly class ProjectsApi extends GitLabApi
{
    /**
     * @return list<ProjectResource>
     * @throws GitlabException|DateMalformedStringException
     */
    public function list(int $page = 1, int $perPage = 20, bool $membership = true): array
    {
        $projectList = [];
        $response = $this->getHttpClient()->getJson('projects', [
            'page' => $page,
            'per_page' => $perPage,
            'membership' => $membership ? 'true' : 'false',
            'simple' => 'true',
        ]);

        /** @var list<ProjectArray> $response */
        foreach ($response as $project) {
            $projectList[] = new ProjectResource(
                client: $this->getClient(),
                projectId: $project['id']
            );
        }

        return $projectList;
    }

    public function get(int|string $idOrPath): ProjectResource
    {
        /** @var ProjectArray $response */
        $response = $this->getHttpClient()->getJson(
            'projects/' . $this->encodeProjectId($idOrPath)
        );

        return new ProjectResource(
            client: $this->getClient(),
            projectId: $response['id'],
            details: Project::fromArray($response)
        );
    }

    public function fetchDetails(int|string $idOrPath): Project
    {
        return $this->get($idOrPath)->details();
    }
}
