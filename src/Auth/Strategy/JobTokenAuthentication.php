<?php

namespace NuToolBox\Gitlab\Auth\Strategy;

use NuToolBox\Gitlab\Auth\AuthenticationStrategy;
use Psr\Http\Message\RequestInterface;

/**
 * see https://docs.gitlab.com/api/rest/authentication/#job-tokens
 *
 * You can use job tokens to authenticate with specific API endpoints. In GitLab CI/CD jobs,
 * the token is available as the CI_JOB_TOKEN variable.
 */
final readonly class JobTokenAuthentication implements AuthenticationStrategy
{
    // TODO: https://docs.gitlab.com/ci/jobs/ci_job_token/#job-token-access
    public const array ALLOWED = [
        'JobApi'
    ];

    public function __construct(private string $token)
    {
    }

    public function authenticate(RequestInterface $request): RequestInterface
    {
        return $request->withHeader('JOB-TOKEN', $this->token);
    }
}
