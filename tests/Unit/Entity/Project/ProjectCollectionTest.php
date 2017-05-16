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

namespace Cog\YouTrack\Tests\Unit\Entity\Project;

use Cog\YouTrack\Entity\Project\Project;
use Cog\YouTrack\Entity\Project\ProjectCollection;
use Cog\YouTrack\Tests\TestCase;

/**
 * Class ProjectCollectionTest.
 *
 * @package Cog\YouTrack\Tests\Unit\Entity\Project
 */
class ProjectCollectionTest extends TestCase
{
    /** @test */
    public function it_can_get_all_projects_in_project_collection()
    {
        $collection = new ProjectCollection();
        $projects = [
            new Project(),
            new Project(),
            new Project(),
        ];
        $this->setPrivateProperty($collection, 'items', $projects);

        $assertProjects = $collection->all();

        $this->assertEquals($projects, $assertProjects);
    }

    /** @test */
    public function it_can_add_project_in_project_collection()
    {
        $collection = new ProjectCollection();
        $project = new Project();

        $collection->add($project);

        $this->assertAttributeContains($project, 'items', $collection);
    }

    /** @test */
    public function it_can_remove_project_from_project_collection()
    {
        $collection = new ProjectCollection();
        $project = new Project();
        $this->setPrivateProperty($collection, 'items', [$project]);

        $collection->remove($project);

        $this->assertAttributeEmpty('items', $collection);
    }

    /** @test */
    public function it_can_get_project_by_key_in_project_collection()
    {
        $collection = new ProjectCollection();
        $project1 = new Project();
        $project2 = new Project();
        $project3 = new Project();
        $this->setPrivateProperty($collection, 'items', [
            $project1, $project2, $project3,
        ]);

        $assertProject2 = $collection->get(1);

        $this->assertSame($project2, $assertProject2);
    }

    /** @test */
    public function it_can_check_if_project_exists_in_project_collection()
    {
        $collection = new ProjectCollection();
        $project1 = new Project();
        $project2 = new Project();
        $this->setPrivateProperty($collection, 'items', [
            $project1, $project2,
        ]);

        $isExists = $collection->has($project2);

        $this->assertTrue($isExists);
    }

    /** @test */
    public function it_can_check_if_project_not_exists_in_project_collection()
    {
        $collection = new ProjectCollection();
        $project1 = new Project();
        $project2 = new Project();
        $project3 = new Project();
        $this->setPrivateProperty($collection, 'items', [
            $project1, $project2,
        ]);

        $isExists = $collection->has($project3);

        $this->assertFalse($isExists);
    }

    /** @test */
    public function it_can_clear_project_collection()
    {
        $collection = new ProjectCollection();
        $projects = [
            new Project(),
            new Project(),
            new Project(),
        ];
        $this->setPrivateProperty($collection, 'items', $projects);

        $collection->clear();

        $this->assertAttributeEmpty('items', $collection);
    }

    /** @test */
    public function it_can_convert_project_collection_to_array()
    {
        $collection = new ProjectCollection();
        $projects = [
            new Project(),
            new Project(),
            new Project(),
        ];
        $this->setPrivateProperty($collection, 'items', $projects);

        $array = $collection->toArray();

        $this->assertEquals($projects, $array);
    }
}
