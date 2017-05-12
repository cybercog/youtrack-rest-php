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
use Cog\YouTrack\Tests\TestCase;

/**
 * Class ProjectTest.
 *
 * @package Cog\YouTrack\Tests\Unit\Entity\Project
 */
class ProjectTest extends TestCase
{
    /** @test */
    public function it_can_set_name()
    {
        $project = new Project();

        $project->setName('Test');

        $this->assertAttributeEquals('Test', 'name', $project);
    }

    /** @test */
    public function it_can_set_id()
    {
        $project = new Project();

        $project->setId('TEST');

        $this->assertAttributeEquals('TEST', 'id', $project);
    }

    /** @test */
    public function it_can_set_description()
    {
        $project = new Project();

        $project->setDescription('Test description');

        $this->assertAttributeEquals('Test description', 'description', $project);
    }

    /** @test */
    public function it_can_set_archived()
    {
        $project = new Project();

        $project->setArchived(true);

        $this->assertAttributeSame(true, 'archived', $project);
    }

    /** @test */
    public function it_can_set_lead()
    {
        $project = new Project();

        $project->setLead('test.user');

        $this->assertAttributeEquals('test.user', 'lead', $project);
    }

    /** @test */
    public function it_can_set_starting_number()
    {
        $project = new Project();

        $project->setStartingNumber(4);

        $this->assertAttributeSame(4, 'startingNumber', $project);
    }

    /** @test */
    public function it_can_set_url()
    {
        $project = new Project();

        $project->setUrl('https://cybercog.su');

        $this->assertAttributeSame('https://cybercog.su', 'url', $project);
    }

    /** @test */
    public function it_can_set_assignees_url()
    {
        $project = new Project();

        $project->setAssigneesUrl('https://cybercog.su');

        $this->assertAttributeSame('https://cybercog.su', 'assigneesUrl', $project);
    }

    /** @test */
    public function it_can_set_subsystems_url()
    {
        $project = new Project();

        $project->setSubsystemsUrl('https://cybercog.su');

        $this->assertAttributeSame('https://cybercog.su', 'subsystemsUrl', $project);
    }

    /** @test */
    public function it_can_set_builds_url()
    {
        $project = new Project();

        $project->setBuildsUrl('https://cybercog.su');

        $this->assertAttributeSame('https://cybercog.su', 'buildsUrl', $project);
    }

    /** @test */
    public function it_can_set_versions_url()
    {
        $project = new Project();

        $project->setVersionsUrl('https://cybercog.su');

        $this->assertAttributeSame('https://cybercog.su', 'versionsUrl', $project);
    }

    /** @test */
    public function it_can_get_name()
    {
        $project = new Project();
        $this->setPrivateProperty($project, 'name', 'Test');

        $name = $project->getName();

        $this->assertEquals('Test', $name);
    }

    /** @test */
    public function it_can_get_id()
    {
        $project = new Project();
        $this->setPrivateProperty($project, 'id', 'TEST');

        $id = $project->getId();

        $this->assertEquals('TEST', $id);
    }

    /** @test */
    public function it_can_get_description()
    {
        $project = new Project();
        $this->setPrivateProperty($project, 'description', 'TEST');

        $description = $project->getDescription();

        $this->assertEquals('TEST', $description);
    }

    /** @test */
    public function it_can_get_archived()
    {
        $project = new Project();
        $this->setPrivateProperty($project, 'archived', true);

        $archived = $project->getArchived();

        $this->assertTrue($archived);
    }

    /** @test */
    public function it_can_get_lead()
    {
        $project = new Project();
        $this->setPrivateProperty($project, 'lead', 'TEST');

        $lead = $project->getLead();

        $this->assertEquals('TEST', $lead);
    }

    /** @test */
    public function it_can_get_starting_number()
    {
        $project = new Project();
        $this->setPrivateProperty($project, 'startingNumber', 4);

        $startingNumber = $project->getStartingNumber();

        $this->assertSame(4, $startingNumber);
    }

    /** @test */
    public function it_can_get_url()
    {
        $project = new Project();
        $this->setPrivateProperty($project, 'url', 'https://cybercog.su');

        $url = $project->getUrl();

        $this->assertEquals('https://cybercog.su', $url);
    }

    /** @test */
    public function it_can_get_assignees_url()
    {
        $project = new Project();
        $this->setPrivateProperty($project, 'assigneesUrl', 'https://cybercog.su');

        $assigneesUrl = $project->getAssigneesUrl();

        $this->assertEquals('https://cybercog.su', $assigneesUrl);
    }

    /** @test */
    public function it_can_get_subsystems_url()
    {
        $project = new Project();
        $this->setPrivateProperty($project, 'subsystemsUrl', 'https://cybercog.su');

        $subsystemsUrl = $project->getSubsystemsUrl();

        $this->assertEquals('https://cybercog.su', $subsystemsUrl);
    }

    /** @test */
    public function it_can_get_builds_url()
    {
        $project = new Project();
        $this->setPrivateProperty($project, 'buildsUrl', 'https://cybercog.su');

        $buildsUrl = $project->getBuildsUrl();

        $this->assertEquals('https://cybercog.su', $buildsUrl);
    }

    /** @test */
    public function it_can_get_versions_url()
    {
        $project = new Project();
        $this->setPrivateProperty($project, 'versionsUrl', 'https://cybercog.su');

        $versionsUrl = $project->getVersionsUrl();

        $this->assertEquals('https://cybercog.su', $versionsUrl);
    }
}
