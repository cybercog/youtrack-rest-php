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

use Cog\YouTrack\Entity\Issue\Comment;
use Cog\YouTrack\Entity\Issue\Field;
use Cog\YouTrack\Entity\Issue\Issue;
use Cog\YouTrack\Tests\TestCase;

/**
 * Class IssueTest.
 *
 * @package Cog\YouTrack\Tests\Unit\Entity\Issue
 */
class IssueTest extends TestCase
{
    /** @test */
    public function it_can_set_id()
    {
        $issue = new Issue();

        $issue->setId('TEST-1');

        $this->assertAttributeEquals('TEST-1', 'id', $issue);
    }

    /** @test */
    public function it_can_set_jira_id()
    {
        $issue = new Issue();

        $issue->setJiraId('TEST-1');

        $this->assertAttributeEquals('TEST-1', 'jiraId', $issue);
    }

    /** @test */
    public function it_can_set_project_short_name()
    {
        $issue = new Issue();

        $issue->setProjectShortName('TEST');

        $this->assertAttributeEquals('TEST', 'projectShortName', $issue);
    }

    /** @test */
    public function it_can_set_number_in_project()
    {
        $issue = new Issue();

        $issue->setNumberInProject(1);

        $this->assertAttributeSame(1, 'numberInProject', $issue);
    }

    /** @test */
    public function it_can_set_summary()
    {
        $issue = new Issue();

        $issue->setSummary('Test summary');

        $this->assertAttributeEquals('Test summary', 'summary', $issue);
    }

    /** @test */
    public function it_can_set_description()
    {
        $issue = new Issue();

        $issue->setDescription('Test description');

        $this->assertAttributeEquals('Test description', 'description', $issue);
    }

    /** @test */
    public function it_can_set_created()
    {
        $issue = new Issue();

        $issue->setCreated('2017-01-01 00:00:00');

        $this->assertAttributeEquals('2017-01-01 00:00:00', 'created', $issue);
    }

    /** @test */
    public function it_can_set_updated()
    {
        $issue = new Issue();

        $issue->setUpdated('2017-01-01 00:00:00');

        $this->assertAttributeEquals('2017-01-01 00:00:00', 'updated', $issue);
    }

    /** @test */
    public function it_can_set_updater_name()
    {
        $issue = new Issue();

        $issue->setUpdaterName('Test updater');

        $this->assertAttributeEquals('Test updater', 'updaterName', $issue);
    }

    /** @test */
    public function it_can_set_resolved()
    {
        $issue = new Issue();

        $issue->setResolved('2017-01-01 00:00:00');

        $this->assertAttributeEquals('2017-01-01 00:00:00', 'resolved', $issue);
    }

    /** @test */
    public function it_can_set_reporter_name()
    {
        $issue = new Issue();

        $issue->setReporterName('Test reporter');

        $this->assertAttributeEquals('Test reporter', 'reporterName', $issue);
    }

    /** @test */
    public function it_can_set_voter_name()
    {
        $issue = new Issue();

        $issue->setVoterName('Test voter');

        $this->assertAttributeEquals('Test voter', 'voterName', $issue);
    }

    /** @test */
    public function it_can_set_comments_count()
    {
        $issue = new Issue();

        $issue->setCommentsCount(4);

        $this->assertAttributeSame(4, 'commentsCount', $issue);
    }

    /** @test */
    public function it_can_set_votes_count()
    {
        $issue = new Issue();

        $issue->setVotes(4);

        $this->assertAttributeSame(4, 'votes', $issue);
    }

    /** @test */
    public function it_can_set_permitted_group()
    {
        $issue = new Issue();

        $issue->setPermittedGroup('Test group');

        $this->assertAttributeEquals('Test group', 'permittedGroup', $issue);
    }

    /** @test */
    public function it_can_set_comments()
    {
        $issue = new Issue();
        $comments = [
            new Comment(),
            new Comment(),
        ];

        $issue->setComment($comments);

        $this->assertAttributeSame($comments, 'comment', $issue);
    }

    /** @test */
    public function it_can_set_tags()
    {
        $issue = new Issue();
        $tags = [
            'test',
            'tag',
        ];

        $issue->setTag($tags);

        $this->assertAttributeSame($tags, 'tag', $issue);
    }

    /** @test */
    public function it_can_set_fields()
    {
        $issue = new Issue();
        $fields = [
            new Field(),
            new Field(),
        ];

        $issue->setField($fields);

        $this->assertAttributeSame($fields, 'field', $issue);
    }

    /** @test */
    public function it_can_get_id()
    {
        $issue = new Issue();
        $this->setPrivateProperty($issue, 'id', 'TEST-1');

        $id = $issue->getId();

        $this->assertEquals('TEST-1', $id);
    }

    /** @test */
    public function it_can_get_jira_id()
    {
        $issue = new Issue();
        $this->setPrivateProperty($issue, 'jiraId', 'TEST-1');

        $jiraId = $issue->getJiraId();
        
        $this->assertEquals('TEST-1', $jiraId);
    }

    /** @test */
    public function it_can_get_project_short_name()
    {
        $issue = new Issue();
        $this->setPrivateProperty($issue, 'projectShortName', 'TEST');

        $projectShortName = $issue->getProjectShortName();

        $this->assertEquals('TEST', $projectShortName);
    }

    /** @test */
    public function it_can_get_number_in_project()
    {
        $issue = new Issue();
        $this->setPrivateProperty($issue, 'numberInProject', 1);

        $numberInProject = $issue->getNumberInProject();

        $this->assertSame(1, $numberInProject);
    }

    /** @test */
    public function it_can_get_summary()
    {
        $issue = new Issue();
        $this->setPrivateProperty($issue, 'summary', 'Test summary');

        $summary = $issue->getSummary();

        $this->assertEquals('Test summary', $summary);
    }

    /** @test */
    public function it_can_get_description()
    {
        $issue = new Issue();
        $this->setPrivateProperty($issue, 'description', 'Test description');

        $description = $issue->getDescription();

        $this->assertEquals('Test description', $description);
    }

    /** @test */
    public function it_can_get_created()
    {
        $issue = new Issue();
        $this->setPrivateProperty($issue, 'created', '2017-01-01 00:00:00');

        $created = $issue->getCreated();

        $this->assertEquals('2017-01-01 00:00:00', $created);
    }

    /** @test */
    public function it_can_get_updated()
    {
        $issue = new Issue();
        $this->setPrivateProperty($issue, 'updated', '2017-01-01 00:00:00');

        $updated = $issue->getUpdated();

        $this->assertEquals('2017-01-01 00:00:00', $updated);
    }

    /** @test */
    public function it_can_get_updater_name()
    {
        $issue = new Issue();
        $this->setPrivateProperty($issue, 'updaterName', 'Test updater');

        $updaterName = $issue->getUpdaterName();

        $this->assertEquals('Test updater', $updaterName);
    }

    /** @test */
    public function it_can_get_resolved()
    {
        $issue = new Issue();
        $this->setPrivateProperty($issue, 'resolved', '2017-01-01 00:00:00');

        $resolved = $issue->getResolved();

        $this->assertEquals('2017-01-01 00:00:00', $resolved);
    }

    /** @test */
    public function it_can_get_reporter_name()
    {
        $issue = new Issue();
        $this->setPrivateProperty($issue, 'reporterName', 'Test reporter');

        $reporterName = $issue->getReporterName();

        $this->assertEquals('Test reporter', $reporterName);
    }

    /** @test */
    public function it_can_get_voter_name()
    {
        $issue = new Issue();
        $this->setPrivateProperty($issue, 'voterName', 'Test voter');

        $voterName = $issue->getVoterName();

        $this->assertEquals('Test voter', $voterName);
    }

    /** @test */
    public function it_can_get_comments_count()
    {
        $issue = new Issue();
        $this->setPrivateProperty($issue, 'commentsCount', 4);

        $commentsCount = $issue->getCommentsCount();

        $this->assertSame(4, $commentsCount);
    }

    /** @test */
    public function it_can_get_votes_count()
    {
        $issue = new Issue();
        $this->setPrivateProperty($issue, 'votes', 4);

        $votesCount = $issue->getVotes();

        $this->assertSame(4, $votesCount);
    }

    /** @test */
    public function it_can_get_permitted_group()
    {
        $issue = new Issue();
        $this->setPrivateProperty($issue, 'permittedGroup', 'Test group');

        $permittedGroup = $issue->getPermittedGroup();

        $this->assertEquals('Test group', $permittedGroup);
    }

    /** @test */
    public function it_can_get_comments()
    {
        $issue = new Issue();
        $comment1 = new Comment();
        $comment2 = new Comment();
        $comments = [
            $comment1,
            $comment2,
        ];
        $this->setPrivateProperty($issue, 'comment', $comments);

        $actualComments = $issue->getComment();

        $this->assertSame($comments, $actualComments);
    }

    /** @test */
    public function it_can_get_tags()
    {
        $issue = new Issue();
        $tags = [
            'test',
            'tag',
        ];
        $this->setPrivateProperty($issue, 'tag', $tags);

        $actualTags = $issue->getTag();

        $this->assertSame($tags, $actualTags);
    }

    /** @test */
    public function it_can_get_fields()
    {
        $issue = new Issue();
        $fields = [
            'test',
            'field',
        ];
        $this->setPrivateProperty($issue, 'field', $fields);

        $actualFields = $issue->getField();

        $this->assertSame($fields, $actualFields);
    }

    /**
     * @test
     *
     * TODO: Move to Hydrator tests
     */
    public function it_can_fill_id()
    {
        $issue = new Issue([
            'id' => 'TEST-1',
        ]);

        $this->assertEquals('TEST-1', $issue->getId());
    }

    /**
     * @test
     *
     * TODO: Move to Hydrator tests
     */
    public function it_can_fill_jira_id()
    {
        $issue = new Issue([
            'jiraId' => 'TEST-1',
        ]);

        $this->assertEquals('TEST-1', $issue->getJiraId());
    }
}
