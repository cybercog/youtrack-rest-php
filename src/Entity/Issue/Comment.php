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
 * YouTrack Issue Comment Entity.
 *
 * @package Cog\YouTrack\Entity\Issue
 */
class Comment
{
    use HasHydrator;

    /**
     * Comment id in database.
     *
     * @var string
     */
    private $id;

    /**
     * Login of the user, who posted this comment.
     *
     * @var string
     */
    private $author;

    /**
     * Full name of the user, who posted this comment.
     *
     * @var string
     */
    private $authorFullName;

    /**
     * Id of the issue, that comment belongs to.
     *
     * @var string
     */
    private $issueId;

    /**
     * Id of the parent issue.
     *
     * @var string
     */
    private $parentId;

    /**
     * True if comment was deleted from issue, false if not.
     *
     * @var bool
     */
    private $deleted;

    /**
     * If this comment was initially imported from JIRA, shows id of this comment in JIRA.
     *
     * @var string
     */
    private $jiraId;

    /**
     * Text of the comment.
     *
     * @var string
     */
    private $text;

    /**
     * @var bool
     */
    private $shownForIssueAuthor;

    /**
     * Time when this comment was created (Unix time format).
     *
     * @var int
     */
    private $created;

    /**
     * Time when this comment was last updated (Unix time format).
     *
     * @var int
     */
    private $updated;

    /**
     * User group, that has permission to read this comment;
     * if group is not set, it means that any user has access to this comment.
     *
     * @var string
     */
    private $permittedGroup;

    /**
     * @var array
     */
    private $replies;

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
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @return string
     */
    public function getAuthorFullName(): string
    {
        return $this->authorFullName;
    }

    /**
     * @return string
     */
    public function getJiraId(): string
    {
        return $this->jiraId;
    }

    /**
     * @return boolean
     */
    public function getDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * @return string
     */
    public function getIssueId(): string
    {
        return $this->issueId;
    }

    /**
     * @return string
     */
    public function getParentId(): string
    {
        return $this->parentId;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return bool
     */
    public function getShownForIssueAuthor(): bool
    {
        return $this->shownForIssueAuthor;
    }

    /**
     * @return int
     */
    public function getCreated(): int
    {
        return $this->created;
    }

    /**
     * @return int
     */
    public function getUpdated(): int
    {
        return $this->updated;
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
    public function getReplies(): array
    {
        return $this->replies;
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
     * @param string $author
     * @return void
     */
    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    /**
     * @param string $fullName
     * @return void
     */
    public function setAuthorFullName(string $fullName): void
    {
        $this->authorFullName = $fullName;
    }

    /**
     * @param string $issueId
     * @return void
     */
    public function setIssueId(string $issueId): void
    {
        $this->issueId = $issueId;
    }

    /**
     * @param string $parentId
     * @return void
     */
    public function setParentId(string $parentId): void
    {
        $this->parentId = $parentId;
    }

    /**
     * @param string|bool $isDeleted
     * @return void
     */
    public function setDeleted($isDeleted): void
    {
        $this->deleted = (bool) $isDeleted;
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
     * @param string $text
     * @return void
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @param bool $isShowToAuthor
     * @return void
     */
    public function setShownForIssueAuthor(bool $isShowToAuthor): void
    {
        $this->shownForIssueAuthor = $isShowToAuthor;
    }

    /**
     * @param int $createdAt Unix timestamp
     * @return void
     */
    public function setCreated(int $createdAt): void
    {
        $this->created = $createdAt;
    }

    /**
     * @param int $updatedAt Unix timestamp
     * @return void
     */
    public function setUpdated(int $updatedAt): void
    {
        $this->updated = $updatedAt;
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
     * @param array $replies
     * @return void
     */
    public function setReplies(array $replies): void
    {
        $this->replies = $replies;
    }
}
