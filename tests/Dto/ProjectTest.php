<?php

namespace NuToolBox\Gitlab\Tests\Dto;

use DateMalformedStringException;
use NuToolBox\Gitlab\Dto\Project;
use NuToolBox\Gitlab\Tests\Support\Fixtures;
use PHPUnit\Framework\TestCase;

/**
 * @phpstan-import-type ProjectArray from Project
 */
class ProjectTest extends TestCase
{
    /**
     * @throws DateMalformedStringException
     */
    public function testFromArrayMapsProjectCorrectly(): void
    {
        $json = Fixtures::load('gitlab/projects/list_success.json');

        /** @var list<ProjectArray> $projects */
        $projects = json_decode($json, true);
        $project = $projects[rand(0, count($projects))];

        $projectDto = Project::fromArray($project);

        self::assertSame($project['id'], $projectDto->id);
        self::assertSame($project['name'], $projectDto->name);
        self::assertSame($project['path'], $projectDto->path);
        self::assertSame($project['path_with_namespace'], $projectDto->pathWithNamespace);
        self::assertSame($project['default_branch'], $projectDto->defaultBranch);
        self::assertSame($project['web_url'], $projectDto->webUrl);
    }
}
