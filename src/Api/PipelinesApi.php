<?php

namespace NuToolBox\Gitlab\Api;

use NuToolBox\Gitlab\Dto\Pipeline;
use NuToolBox\Gitlab\Exception\GitlabException;

/**
 * @phpstan-import-type PipelineArray from Pipeline
 */
final readonly class PipelinesApi extends GitLabApi
{
    /**
     * @return list<Pipeline>
     * @throws GitlabException
     */
    public function list(int|string $projectIdOrPath): array
    {
        $pipelineList = [];

        /** @var list<PipelineArray> $pipelines */
        $pipelines = $this
            ->getHttpClient()
            ->getJson('/projects/' . $this->encodeProjectId($projectIdOrPath) . '/pipelines');

        if (count($pipelines) > 0) {
            foreach ($pipelines as $pipeline) {
                $pipelineList[] = Pipeline::fromArray($pipeline);
            }
        }

        return $pipelineList;
    }
}
