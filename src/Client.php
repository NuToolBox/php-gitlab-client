<?php

namespace NuToolBox\Gitlab;

use NuToolBox\Gitlab\Api\MetadataApi;
use NuToolBox\Gitlab\Api\ProjectsApi;
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

    public function projects(): ProjectsApi
    {
        return new ProjectsApi($this->httpClient);
    }

    public function metadata(): MetadataApi
    {
        return new MetadataApi($this->httpClient);
    }
}
