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
use Cog\YouTrack\Repositories\IssueRepository;
use Cog\YouTrack\Tests\TestCase;

/**
 * Class IssueRepositoryTest.
 *
 * @package Cog\YouTrack\Tests\Unit\Repositories
 */
class IssueRepositoryTest extends TestCase
{
    private $project = 'LARABOT';
    private $issue = 'LARABOT-1';

    /** @test */
    public function it_can_get_issue()
    {
        $repository = $this->app->make(IssueRepository::class);
        $issueId = $this->issue;

        $issue = $repository->find($issueId);

        $this->assertInstanceOf(Issue::class, $issue);
        $this->assertEquals($issueId, $issue->getId());
    }

    /**
     * test
     * TODO: Test it
     */
    public function it_can_create_issue()
    {
        $repository = $this->app->make(IssueRepository::class);
        $attributes = [
            'project' => $this->project,
            'summary' => 'Test issue create',
            'description' => 'Test description',
            //'attachments' => null, // TODO: Implement add attachments
            //'permittedGroup' => null', // TODO: Test permitted groups
        ];

        $repository->create($attributes);
    }

    /** @test */
    public function it_can_update_issue()
    {
        $repository = $this->app->make(IssueRepository::class);
        $issueId = $this->issue;
        $issue = $repository->find($issueId);
        $newDescription = 'Updated: ' . time();

        $repository->update($issueId, [
            'summary' => $issue->getSummary(),
            'description' => $newDescription,
        ]);

        // TODO: How to check it without real API call
        $this->assertEquals($newDescription, $repository->find($issueId)->getDescription());
    }

    /** @test */
    public function it_can_check_if_issue_exists()
    {
        $repository = $this->app->make(IssueRepository::class);
        $issueId = $this->issue;

        $exists = $repository->exists($issueId);

        $this->assertTrue($exists);
    }

    /** @test */
    public function it_can_check_if_issue_not_exists()
    {
        $repository = $this->app->make(IssueRepository::class);
        $issueId = 'UNEXIST-ISSUE';

        $exists = $repository->exists($issueId);

        $this->assertFalse($exists);
    }
}
