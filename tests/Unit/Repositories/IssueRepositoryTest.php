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
}
