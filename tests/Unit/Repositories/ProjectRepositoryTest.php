<?php

declare(strict_types=1);

/*
 * This file is part of YouTrack REST PHP.
 *
 * (c) Anton Komarev <a.komarev@cybercog.su>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cog\YouTrack\Tests\Unit\Repositories;

use Cog\YouTrack\Entity\Project\Project;
use Cog\YouTrack\Repositories\ProjectRepository;
use Cog\YouTrack\Tests\TestCase;

/**
 * Class ProjectRepositoryTest.
 *
 * @package Cog\YouTrack\Tests\Unit\Repositories
 */
class ProjectRepositoryTest extends TestCase
{
    private $project = 'LARABOT';

    /** @test */
    public function it_can_get_project()
    {
        $repository = $this->app->make(ProjectRepository::class);
        $projectId = $this->project;

        $project = $repository->projectGet($projectId);

        $this->assertInstanceOf(Project::class, $project);
        $this->assertEquals($projectId, $project->getId());
    }
}
