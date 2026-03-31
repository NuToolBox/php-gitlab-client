<?php

namespace NuToolBox\Gitlab\Api;

use DateMalformedStringException;
use NuToolBox\Gitlab\Api\Project\ProjectResource;
use NuToolBox\Gitlab\Client;
use NuToolBox\Gitlab\Dto\Project;
use NuToolBox\Gitlab\Exception\GitlabException;
use NuToolBox\Gitlab\Http\GitlabHttpClient;

/**
 * @phpstan-import-type ProjectArray from Project
 */
final readonly class ProjectsApi
{
    private GitlabHttpClient $httpClient;

    public function __construct(
        private Client $client
    ) {
        $this->httpClient = $this->client->getHttpClient();
    }

    /**
     * @return list<ProjectResource>
     * @throws GitlabException|DateMalformedStringException
     */
    public function list(int $page = 1, int $perPage = 20, bool $membership = true): array
    {
        $projectList = [];
        $response = $this->httpClient->get('projects', [
            'page' => $page,
            'per_page' => $perPage,
            'membership' => $membership ? 'true' : 'false',
            'simple' => 'true',
        ]);

        /** @var list<ProjectArray> $response */
        foreach ($response as $project) {
            $projectList[] = new ProjectResource(
                client: $this->client,
                projectId: $project['id']
            );
        }

        return $projectList;
    }

    public function get(int|string $idOrPath): ProjectResource
    {
        /** @var ProjectArray $response */
        $response = $this->httpClient->get(
            'projects/' . $this->encodeProjectId($idOrPath)
        );

        return new ProjectResource(
            client: $this->client,
            projectId: $response['id'],
            details: Project::fromArray($response)
        );
    }

    public function fetchDetails(int|string $idOrPath): Project
    {
        return $this->get($idOrPath)->details();
    }

    private function encodeProjectId(int|string $idOrPath): string
    {
        if (is_int($idOrPath)) {
            return (string) $idOrPath;
        }

        return rawurlencode($idOrPath);
    }
}
