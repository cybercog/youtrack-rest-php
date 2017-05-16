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
use InvalidArgumentException;
use stdClass;

/**
 * Class ProjectCollectionTest.
 *
 * @package Cog\YouTrack\Tests\Unit\Entity\Project
 */
class ProjectCollectionTest extends TestCase
{
    /** @test */
    public function it_can_instantiate_collection_with_items()
    {
        $projects = [
            new Project(),
            new Project(),
            new Project(),
        ];

        $collection = new ProjectCollection($projects);

        $this->assertAttributeSame($projects, 'items', $collection);
    }

    /** @test */
    public function it_can_throw_exception_on_collection_instantiation_with_invalid_items()
    {
        $projects = [
            new Project(),
            new stdClass(),
            new Project(),
        ];

        $this->expectException(InvalidArgumentException::class);

        new ProjectCollection($projects);
    }

    /** @test */
    public function it_can_make_collection()
    {
        $projects = [
            new Project(),
            new Project(),
            new Project(),
        ];

        $collection = ProjectCollection::make($projects);

        $this->assertAttributeSame($projects, 'items', $collection);
    }

    /** @test */
    public function it_can_throw_exception_on_make_collection_with_invalid_item()
    {
        $projects = [
            new Project(),
            new stdClass(),
            new Project(),
        ];

        $this->expectException(InvalidArgumentException::class);

        ProjectCollection::make($projects);
    }

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

        $collection->forget($project);

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
    public function it_can_fallback_to_default_value_on_project_get_by_key_in_project_collection()
    {
        $collection = new ProjectCollection();
        $project = new Project();
        $this->setPrivateProperty($collection, 'items', [
            $project,
        ]);

        $assertFallback = $collection->get(999, 'test-fallback');

        $this->assertEquals('test-fallback', $assertFallback);
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

    /**
     * test
     * TODO: Test is broken because all Project properties are private
     */
    public function it_can_convert_project_collection_to_json()
    {
        $wantsJson = json_encode([
            ['id' => 'TEST-1',],
            ['id' => 'TEST-2',],
            ['id' => 'TEST-3',],
        ]);
        $collection = new ProjectCollection();
        // TODO: Use factories here
        $projects = [
            Project::make(['id' => 'TEST-1']),
            Project::make(['id' => 'TEST-2']),
            Project::make(['id' => 'TEST-3']),
        ];
        $this->setPrivateProperty($collection, 'items', $projects);

        $json = $collection->toJson();

        $this->assertEquals($wantsJson, $json);
    }

    /** @test */
    public function it_can_count_projects_in_collection()
    {
        $collection = new ProjectCollection();
        $projects = [
            new Project(),
            new Project(),
            new Project(),
        ];
        $this->setPrivateProperty($collection, 'items', $projects);

        $projectsCount = $collection->count();

        $this->assertEquals(3, $projectsCount);
    }

    /** @test */
    public function it_can_set_project_in_collection()
    {
        $collection = new ProjectCollection();

        $collection->offsetSet(null, new Project());
        $collection->offsetSet(null, new Project());

        $this->assertAttributeCount(2, 'items', $collection);
    }

    /** @test */
    public function it_can_throw_exception_on_offset_set_not_a_project_in_collection()
    {
        $collection = new ProjectCollection();

        $this->expectException(InvalidArgumentException::class);

        $collection->offsetSet(null, new stdClass());
    }

    /** @test */
    public function it_can_overwrite_project_on_offset_set_in_collection()
    {
        $collection = new ProjectCollection();
        $project1 = Project::make(['id' => 'TEST-1',]);
        $project2 = Project::make(['id' => 'TEST-2',]);
        $projectOverwrite = Project::make(['id' => 'TEST-3',]);
        $projects = [
            $project1,
            $project2,
        ];
        $assertProjects = [
            $projectOverwrite,
            $project2,
        ];
        $this->setPrivateProperty($collection, 'items', $projects);

        $collection->offsetSet(0, $projectOverwrite);

        $this->assertAttributeSame($assertProjects, 'items', $collection);
    }

    /** @test */
    public function it_can_get_project_by_offset_get_key_in_project_collection()
    {
        $collection = new ProjectCollection();
        $project1 = new Project();
        $project2 = new Project();
        $project3 = new Project();
        $this->setPrivateProperty($collection, 'items', [
            $project1, $project2, $project3,
        ]);

        $assertProject2 = $collection->offsetGet(1);

        $this->assertSame($project2, $assertProject2);
    }

    /** @test */
    public function it_can_get_null_project_by_trying_non_exists_offset_get_in_project_collection()
    {
        $collection = new ProjectCollection();
        $project1 = new Project();
        $project2 = new Project();
        $project3 = new Project();
        $this->setPrivateProperty($collection, 'items', [
            $project1, $project2, $project3,
        ]);

        $assertProject = $collection->offsetGet('non-exist-key');

        $this->assertNull($assertProject);
    }

    /** @test */
    public function it_can_check_if_offset_exists_in_project_collection()
    {
        $collection = new ProjectCollection();
        $project1 = Project::make(['id' => 'TEST-1',]);
        $project2 = Project::make(['id' => 'TEST-2',]);
        $projects = [
            $project1,
            $project2,
        ];
        $this->setPrivateProperty($collection, 'items', $projects);

        $isExists = $collection->offsetExists($project2);

        $this->assertTrue($isExists);
    }

    /** @test */
    public function it_can_check_if_offset_not_exists_in_project_collection()
    {
        $collection = new ProjectCollection();
        $project1 = Project::make(['id' => 'TEST-1',]);
        $project2 = Project::make(['id' => 'TEST-2',]);
        $project3 = Project::make(['id' => 'TEST-3',]);
        $projects = [
            $project1,
            $project2,
        ];
        $this->setPrivateProperty($collection, 'items', $projects);

        $isExists = $collection->offsetExists($project3);

        $this->assertFalse($isExists);
    }
}
