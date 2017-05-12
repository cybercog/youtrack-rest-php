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

namespace Cog\YouTrack\Entity\Project;

use Cog\YouTrack\Traits\HasHydrator;

/**
 * YouTrack Project Entity.
 *
 * @package Cog\YouTrack\Entity\Project
 */
class Project
{
    use HasHydrator;

    /**
     * Full name of a new project. Must be unique.
     *
     * @var string
     */
    private $name;

    /**
     * Unique identifier of a project to be created.
     * This short name will be used as prefix in issue IDs for this project.
     *
     * @var string
     */
    private $id;

    /**
     * Optional description of the new project.
     *
     * @var string
     */
    private $description;

    /**
     * @var bool
     */
    private $archived;

    /**
     * Login name of a user to be assigned as a project leader.
     *
     * @var string
     */
    private $lead;

    /**
     * @var int
     */
    private $startingNumber;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $assigneesUrl;

    /**
     * @var string
     */
    private $subsystemsUrl;

    /**
     * @var string
     */
    private $buildsUrl;

    /**
     * @var string
     */
    private $versionsUrl;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
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
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return bool
     */
    public function getArchived(): bool
    {
        return $this->archived;
    }

    /**
     * @return string
     */
    public function getLead(): string
    {
        return $this->lead;
    }

    /**
     * @return int
     */
    public function getStartingNumber(): int
    {
        return $this->startingNumber;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getAssigneesUrl(): string
    {
        return $this->assigneesUrl;
    }

    /**
     * @return string
     */
    public function getSubsystemsUrl(): string
    {
        return $this->subsystemsUrl;
    }

    /**
     * @return string
     */
    public function getBuildsUrl(): string
    {
        return $this->buildsUrl;
    }

    /**
     * @return string
     */
    public function getVersionsUrl(): string
    {
        return $this->versionsUrl;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
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
     * @param string $description
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
    
    /**
     * @param bool $isArchived
     * @return void
     */
    public function setArchived(bool $isArchived): void
    {
        $this->archived = $isArchived;
    }
    
    /**
     * @param string $lead
     * @return void
     */
    public function setLead(string $lead): void
    {
        $this->lead = $lead;
    }
    
    /**
     * @param int $startingNumber
     * @return void
     */
    public function setStartingNumber(int $startingNumber): void
    {
        $this->startingNumber = $startingNumber;
    }

    /**
     * @param string $url
     * @return void
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @param string $assigneesUrl
     * @return void
     */
    public function setAssigneesUrl(string $assigneesUrl): void
    {
        $this->assigneesUrl = $assigneesUrl;
    }

    /**
     * @param string $subsystemsUrl
     * @return void
     */
    public function setSubsystemsUrl(string $subsystemsUrl): void
    {
        $this->subsystemsUrl = $subsystemsUrl;
    }

    /**
     * @param string $buildsUrl
     * @return void
     */
    public function setBuildsUrl(string $buildsUrl): void
    {
        $this->buildsUrl = $buildsUrl;
    }

    /**
     * @param string $versionsUrl
     * @return void
     */
    public function setVersionsUrl(string $versionsUrl): void
    {
        $this->versionsUrl = $versionsUrl;
    }
}
