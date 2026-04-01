<?php

namespace NuToolBox\Gitlab;

use NuToolBox\Gitlab\Api\AvatarApi;
use NuToolBox\Gitlab\Api\BranchesApi;
use NuToolBox\Gitlab\Api\MetadataApi;
use NuToolBox\Gitlab\Api\PipelinesApi;
use NuToolBox\Gitlab\Api\ProjectsApi;
use NuToolBox\Gitlab\Api\RepositoryFilesApi;
use NuToolBox\Gitlab\Auth\AuthenticationStrategy;
use NuToolBox\Gitlab\Http\GitlabHttpClient;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;

class Client
{
    private GitlabHttpClient $httpClient;

    public function __construct(
        ClientInterface $psrHttpClient,
        RequestFactoryInterface $requestFactory,
        AuthenticationStrategy $authentication,
        string $baseUrl,
    ) {
        $this->httpClient = new GitlabHttpClient(
            httpClient: $psrHttpClient,
            requestFactory: $requestFactory,
            authentication: $authentication,
            baseUrl: $baseUrl,
        );
    }

    public function getHttpClient(): GitlabHttpClient
    {
        return $this->httpClient;
    }

    public function avatar(): AvatarApi
    {
        return new AvatarApi($this);
    }

    public function projects(): ProjectsApi
    {
        return new ProjectsApi($this);
    }

    public function branches(): BranchesApi
    {
        return new BranchesApi($this);
    }

    public function files(): RepositoryFilesApi
    {
        return new RepositoryFilesApi($this);
    }

    public function pipelines(): PipelinesApi
    {
        return new PipelinesApi($this);
    }

    public function metadata(): MetadataApi
    {
        return new MetadataApi($this);
    }
}
