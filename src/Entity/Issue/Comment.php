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

/**
 * YouTrack Issue Comment Entity.
 *
 * @package Cog\YouTrack\Entity\Issue
 */
class Comment
{
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
     * Id of the issue, that comment belongs to.
     *
     * @var string
     */
    private $issueId;

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
     * Time when this comment was created (Unix time format).
     *
     * @var string
     */
    private $created;

    /**
     * Time when this comment was last updated (Unix time format).
     *
     * @var string
     */
    private $updated;

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
    public function getText(): string
    {
        return $this->text;
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
     * @param string $issueId
     * @return void
     */
    public function setIssueId(string $issueId): void
    {
        $this->issueId = $issueId;
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
}
