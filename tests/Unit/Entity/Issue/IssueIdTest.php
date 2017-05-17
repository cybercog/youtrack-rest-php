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

namespace Cog\YouTrack\Tests\Unit\Entity\Issue;

use Cog\YouTrack\Entity\Issue\IssueId;
use Cog\YouTrack\Tests\TestCase;

/**
 * Class IssueIdTest.
 *
 * @package Cog\YouTrack\Tests\Unit\Entity\Issue
 */
class IssueIdTest extends TestCase
{
    /** @test */
    public function it_can_instantiate_issue_id()
    {
        $projectName = 'TEST';
        $issueNumber = 1;

        $issueId = new IssueId($projectName, $issueNumber);

        $this->assertAttributeSame($projectName, 'projectName', $issueId);
        $this->assertAttributeSame($issueNumber, 'id', $issueId);
    }

    /** @test */
    public function it_can_instantiate_issue_id_from_string()
    {
        $issueStringId = 'TEST-1';

        $issueId = IssueId::fromString($issueStringId);

        $this->assertAttributeSame('TEST', 'projectName', $issueId);
        $this->assertAttributeSame(1, 'id', $issueId);
    }
}
