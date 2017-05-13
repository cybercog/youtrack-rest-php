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

use Cog\YouTrack\Entity\Issue\Issue;
use Cog\YouTrack\Repositories\RestIssueRepository;
use Cog\YouTrack\Tests\TestCase;

/**
 * Class RestIssueRepositoryTest.
 *
 * @package Cog\YouTrack\Tests\Unit\Repositories
 */
class RestIssueRepositoryTest extends TestCase
{
    /**
     * @var string
     */
    private $project = 'LARABOT';

    /**
     * @var string
     */
    private $issue = 'LARABOT-1';

    /**
     * @var \Cog\YouTrack\Contracts\IssueRepository
     */
    private $repository;

    /**
     * Actions to be performed on PHPUnit start.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->repository = $this->app->make(RestIssueRepository::class);
    }

    /** @test */
    public function it_can_get_issue()
    {
        $issueId = $this->issue;

        $issue = $this->repository->find($issueId);

        $this->assertInstanceOf(Issue::class, $issue);
        $this->assertEquals($issueId, $issue->getId());
    }

    /**
     * test
     * TODO: Test it.
     */
    public function it_can_create_issue()
    {
        $attributes = [
            'project' => $this->project,
            'summary' => 'Test issue create',
            'description' => 'Test description',
            //'attachments' => null, // TODO: Implement add attachments
            //'permittedGroup' => null', // TODO: Test permitted groups
        ];

        $this->repository->create($attributes);
    }

    /** @test */
    public function it_can_update_issue()
    {
        $issueId = $this->issue;
        $issue = $this->repository->find($issueId);
        $newDescription = 'Updated: ' . time();

        $this->repository->update($issueId, [
            'summary' => $issue->getSummary(),
            'description' => $newDescription,
        ]);

        // TODO: How to check it without real API call
        $this->assertEquals(
            $newDescription,
            $this->repository->find($issueId)->getDescription()
        );
    }

    /** @test */
    public function it_can_check_if_issue_exists()
    {
        $issueId = $this->issue;

        $exists = $this->repository->exists($issueId);

        $this->assertTrue($exists);
    }

    /** @test */
    public function it_can_check_if_issue_not_exists()
    {
        $issueId = 'UNEXIST-ISSUE';

        $exists = $this->repository->exists($issueId);

        $this->assertFalse($exists);
    }
}
