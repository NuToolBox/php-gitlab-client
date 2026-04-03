<?php

namespace NuToolBox\Gitlab\Api;

use NuToolBox\Gitlab\Dto\Dependencies;
use NuToolBox\Gitlab\Exception\AuthorizationException;
use NuToolBox\Gitlab\Exception\FeatureNotAvailableException;
use NuToolBox\Gitlab\Exception\GitlabException;
use NuToolBox\Gitlab\Exception\NotFoundException;

/**
 * @phpstan-import-type DependenciesArray from Dependencies
 */
final readonly class DependenciesApi extends GitLabApi
{
    /**
     * @return array<Dependencies>
     * @throws FeatureNotAvailableException|GitlabException
     */
    public function list(string|int $projectIdOrPath): array
    {
        // This requires "Ultimate" license, but we can not check it before call API
        // @see https://docs.gitlab.com/api/dependencies/

        $dependenciesList = [];

        try {
            /** @var list<DependenciesArray> $dependencies */
            $dependencies = $this
                ->getHttpClient()
                ->getJson('/projects/' . $this->encodeProjectId($projectIdOrPath) . '/dependencies');
        } catch (NotFoundException | AuthorizationException $e) {
            throw new FeatureNotAvailableException(
                feature: 'project_dependencies',
                previous: $e
            );
        }

        if (count($dependencies) > 0) {
            foreach ($dependencies as $dependency) {
                $dependenciesList[] = Dependencies::fromArray($dependency);
            }
        }

        return $dependenciesList;
    }
}
