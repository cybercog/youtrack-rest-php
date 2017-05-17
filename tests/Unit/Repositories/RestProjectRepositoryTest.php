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
use Cog\YouTrack\Entity\Project\ProjectCollection;
use Cog\YouTrack\Repositories\RestProjectRepository;
use Cog\YouTrack\Tests\TestCase;

/**
 * Class RestProjectRepositoryTest.
 *
 * @package Cog\YouTrack\Tests\Unit\Repositories
 */
class RestProjectRepositoryTest extends TestCase
{
    /**
     * @var string
     */
    private $project = 'LARABOT';

    /**
     * @var \Cog\YouTrack\Contracts\ProjectRepository
     */
    private $repository;

    /**
     * Actions to be performed on PHPUnit start.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->repository = $this->app->make(RestProjectRepository::class);
    }

    /** @test */
    public function it_can_list_all_projects()
    {
        $projects = $this->repository->all();

        $this->assertInstanceOf(ProjectCollection::class, $projects);
        $this->assertGreaterThan(0, $projects->count());
        $this->assertInstanceOf(Project::class, $projects->get(0));
    }

    /** @test */
    public function it_can_get_project_by_id()
    {
        $projectId = $this->project;

        $project = $this->repository->find($projectId);

        $this->assertInstanceOf(Project::class, $project);
        $this->assertEquals($projectId, $project->getId());
    }

    /**
     * TODO: Test it.
     */
    public function it_can_create_project_from_array()
    {
        $projectId = 'TESTPROJECT';

        $this->repository->create($projectId, [
            'projectName' => 'Test project',
            'startingNumber' => 4,
            'projectLeadLogin' => 'admin',
            'description' => 'Test description',
        ]);

        // TODO: Assert project being created
    }

    /**
     * TODO: Test it.
     */
    public function it_can_delete_project_by_id()
    {
        $projectId = 'TESTPROJECT';

        $this->repository->delete($projectId);

        // TODO: Assert project being deleted
    }
}
