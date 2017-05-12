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

namespace Cog\YouTrack\Entity\Issue;

use Cog\YouTrack\Traits\HasHydrator;

/**
 * YouTrack Issue Entity.
 *
 * @package Cog\YouTrack\Entity\Issue
 */
class Issue
{
    use HasHydrator;

    /**
     * Issue id in database.
     *
     * @var string
     */
    private $id;

    /**
     * If issue was imported from JIRA, represents id, that it have in JIRA.
     *
     * @var string
     */
    private $jiraId;

    /**
     * Short name of the issue's project.
     *
     * @var string
     */
    private $projectShortName;

    /**
     * Number of issue in project.
     *
     * @var int
     */
    private $numberInProject;

    /**
     * Summary of the issue.
     *
     * @var string
     */
    private $summary;

    /**
     * Description of the issue.
     *
     * @var string
     */
    private $description;

    /**
     * Time when issue was created.
     * (the number of milliseconds since January 1, 1970, 00:00:00 GMT represented by this date).
     *
     * @var string
     */
    private $created;

    /**
     * Time when issue was last updated.
     * (the number of milliseconds since January 1, 1970, 00:00:00 GMT represented by this date).
     *
     * @var string
     */
    private $updated;

    /**
     * Login of the user, that was the last, who updated the issue.
     *
     * @var string
     */
    private $updaterName;

    /**
     * If the issue is resolved, shows time, when resolved state was last set to the issue
     * (the number of milliseconds since January 1, 1970, 00:00:00 GMT represented by this date).
     *
     * @var string
     */
    private $resolved;

    /**
     * Login of user, who created the issue.
     *
     * @var string
     */
    private $reporterName;

    /**
     * Login of user, that voted for issue.
     *
     * @var string
     */
    private $voterName;

    /**
     * Number of comments in issue.
     *
     * @var int
     */
    private $commentsCount;

    /**
     * Number of votes for issue.
     *
     * @var int
     */
    private $votes;

    /**
     * User group, that has permission to read this issue;
     * if group is not set, it means that any user has access to this issue.
     *
     * @var string
     */
    private $permittedGroup;

    /**
     * Represents issue comment.
     *
     * @see https://www.jetbrains.com/help/youtrack/standalone/2017.2/Get-Comments-of-an-Issue.html
     *
     * @var array
     */
    private $comment = [];

    /**
     * Tags, accessible to logged in user.
     *
     * @var array
     */
    private $tag = [];

    /**
     * Represent any field of the issue including custom fields (depending on name attribute).
     * Number and type of fields depends on project settings.
     *
     * @var array
     */
    private $field = [];

    public function __construct(array $attributes = [])
    {
        $this->fill($attributes);
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getJiraId(): string
    {
        return $this->jiraId;
    }

    /**
     * @return string
     */
    public function getProjectShortName(): string
    {
        return $this->projectShortName;
    }

    /**
     * @return int
     */
    public function getNumberInProject(): int
    {
        return $this->numberInProject;
    }

    /**
     * @return string
     */
    public function getSummary(): string
    {
        return $this->summary;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getCreated(): string
    {
        return $this->created;
    }

    /**
     * @return string
     */
    public function getUpdated(): string
    {
        return $this->updated;
    }

    /**
     * @return string
     */
    public function getUpdaterName(): string
    {
        return $this->updaterName;
    }

    /**
     * @return string
     */
    public function getResolved(): string
    {
        return $this->resolved;
    }

    /**
     * @return string
     */
    public function getReporterName(): string
    {
        return $this->reporterName;
    }

    /**
     * @return string
     */
    public function getVoterName(): string
    {
        return $this->voterName;
    }

    /**
     * @return int
     */
    public function getCommentsCount(): int
    {
        return $this->commentsCount;
    }

    /**
     * @return int
     */
    public function getVotes(): int
    {
        return $this->votes;
    }

    /**
     * @return string
     */
    public function getPermittedGroup(): string
    {
        return $this->permittedGroup;
    }

    /**
     * @return array
     */
    public function getComment(): array
    {
        return $this->comment;
    }

    /**
     * @return array
     */
    public function getTag(): array
    {
        return $this->tag;
    }

    /**
     * @return array
     */
    public function getField(): array
    {
        return $this->field;
    }

    /**
     * @param string $id
     * @return void
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $jiraId
     * @return void
     */
    public function setJiraId(string $jiraId): void
    {
        $this->jiraId = $jiraId;
    }

    /**
     * @param string $projectShortName
     * @return void
     */
    public function setProjectShortName(string $projectShortName): void
    {
        $this->projectShortName = $projectShortName;
    }

    /**
     * @param int|string $numberInProject
     * @return void
     */
    public function setNumberInProject($numberInProject): void
    {
        $this->numberInProject = (int) $numberInProject;
    }

    /**
     * @param string $summary
     * @return void
     */
    public function setSummary(string $summary): void
    {
        $this->summary = $summary;
    }

    /**
     * @param string $description
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @param string $createdAt
     * @return void
     */
    public function setCreated(string $createdAt): void
    {
        $this->created = $createdAt;
    }

    /**
     * @param string $updatedAt
     * @return void
     */
    public function setUpdated(string $updatedAt): void
    {
        $this->updated = $updatedAt;
    }

    /**
     * @param string $updaterName
     * @return void
     */
    public function setUpdaterName(string $updaterName): void
    {
        $this->updaterName = $updaterName;
    }

    /**
     * @param string $resolvedAt
     * @return void
     */
    public function setResolved(string $resolvedAt): void
    {
        $this->resolved = $resolvedAt;
    }

    /**
     * @param string $reporterName
     * @return void
     */
    public function setReporterName(string $reporterName): void
    {
        $this->reporterName = $reporterName;
    }

    /**
     * @param string $voterName
     * @return void
     */
    public function setVoterName(string $voterName): void
    {
        $this->voterName = $voterName;
    }

    /**
     * @param int $count
     * @return void
     */
    public function setCommentsCount(int $count): void
    {
        $this->commentsCount = $count;
    }

    /**
     * @param int $count
     * @return void
     */
    public function setVotes(int $count): void
    {
        $this->votes = $count;
    }

    /**
     * @param string $permittedGroup
     * @return void
     */
    public function setPermittedGroup(string $permittedGroup): void
    {
        $this->permittedGroup = $permittedGroup;
    }

    /**
     * @param array $comments
     * @return void
     */
    public function setComment(array $comments): void
    {
        if (!empty($comments) && is_array($comments[0])) {
            foreach ($comments as $key => $commentData) {
                $comment = new Comment();
                $comment->fill($commentData);
                $comments[$key] = $comment;
            }
        }

        $this->comment = $comments;
    }

    /**
     * @param array $tags
     * @return void
     */
    public function setTag(array $tags): void
    {
        $this->tag = $tags;
    }

    /**
     * @param array $fields
     * @return void
     */
    public function setField(array $fields): void
    {
        $this->field = $fields;
    }
}
