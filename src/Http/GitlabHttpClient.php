<?php

declare(strict_types=1);

namespace NuToolBox\Gitlab\Http;

use JsonException;
use NuToolBox\Gitlab\Auth\AuthenticationStrategy;
use NuToolBox\Gitlab\Exception\AuthenticationException;
use NuToolBox\Gitlab\Exception\AuthorizationException;
use NuToolBox\Gitlab\Exception\GitlabException;
use NuToolBox\Gitlab\Exception\NotFoundException;
use NuToolBox\Gitlab\Exception\RateLimitException;
use NuToolBox\Gitlab\Exception\ServerException;
use NuToolBox\Gitlab\Exception\ValidationException;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseInterface;

final readonly class GitlabHttpClient
{
    public function __construct(
        private ClientInterface $httpClient,
        private RequestFactoryInterface $requestFactory,
        private AuthenticationStrategy $authentication,
        private string $baseUrl,
    ) {
    }

    /**
     * @return array<mixed>
     * @throws GitlabException
     */
    public function get(string $path, array $query = []): array
    {
        $url = rtrim($this->baseUrl, '/') . '/api/v4/' . ltrim($path, '/');

        if ($query !== []) {
            $url .= '?' . http_build_query($query);
        }

        $request = $this->requestFactory
            ->createRequest('GET', $url)
            ->withHeader('Accept', 'application/json');

        $request = $this->authentication->authenticate($request);

        $response = $this->httpClient->sendRequest($request);

        $this->throwOnError($response);

        return $this->decodeJsonResponse($response);
    }

    private function throwOnError(ResponseInterface $response): void
    {
        $statusCode = $response->getStatusCode();
        $body = (string) $response->getBody();

        match (true) {
            $statusCode === 401 => throw new AuthenticationException($body, 401),
            $statusCode === 403 => throw new AuthorizationException($body, 403),
            $statusCode === 404 => throw new NotFoundException($body, 404),
            $statusCode === 422 => throw new ValidationException($body, 422),
            $statusCode === 429 => throw new RateLimitException($body, 429),
            $statusCode >= 500 => throw new ServerException($body, $statusCode),
            $statusCode >= 400 => throw new GitlabException($body, $statusCode),
            default => null,
        };
    }

    /**
     * @return array<mixed>
     * @throws GitlabException
     */
    private function decodeJsonResponse(ResponseInterface $response): array
    {
        $body = (string) $response->getBody();

        if ($body === '') {
            return [];
        }

        try {
            $decoded = json_decode($body, true, flags: JSON_THROW_ON_ERROR);
        } catch (JsonException $exception) {
            throw new GitlabException(
                'Failed to decode GitLab API response: ' . $exception->getMessage(),
                previous: $exception,
            );
        }

        if (!is_array($decoded)) {
            throw new GitlabException('GitLab API response must decode to an array.');
        }

        return $decoded;
    }
}
