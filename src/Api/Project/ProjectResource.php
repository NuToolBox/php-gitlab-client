<?php

namespace NuToolBox\Gitlab\Api\Project;

use NuToolBox\Gitlab\Client;
use NuToolBox\Gitlab\Dto\Project;

final class ProjectResource
{
    public function __construct(
        private readonly Client $client,
        private readonly int $projectId,
        private ?Project $details = null,
    ) {
    }

    public function id(): int
    {
        return $this->projectId;
    }

    public function details(): Project
    {
        if ($this->details === null) {
            $this->details = $this->client->projects()->fetchDetails($this->projectId);
        }

        return $this->details;
    }

    public function branches(): ProjectBranchesApi
    {
        return new ProjectBranchesApi($this->client->branches(), $this->projectId);
    }

    public function files(): ProjectRepositoryFilesApi
    {
        return new ProjectRepositoryFilesApi($this->client->files(), $this->projectId);
    }

//    public function commits(): ProjectCommitsApi
//    {
//        return new ProjectCommitsApi($this->client->commits(), $this->projectId);
//    }
}
