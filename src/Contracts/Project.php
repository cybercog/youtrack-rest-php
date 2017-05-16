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

namespace Cog\YouTrack\Contracts;

/**
 * Interface Project.
 *
 * @package Cog\YouTrack\Contracts
 */
interface Project
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return string
     */
    public function getDescription(): string;

    /**
     * @return bool
     */
    public function getArchived(): bool;

    /**
     * @return string
     */
    public function getLead(): string;

    /**
     * @return int
     */
    public function getStartingNumber(): int;

    /**
     * @return string
     */
    public function getUrl(): string;

    /**
     * @return string
     */
    public function getAssigneesUrl(): string;

    /**
     * @return string
     */
    public function getSubsystemsUrl(): string;

    /**
     * @return string
     */
    public function getBuildsUrl(): string;

    /**
     * @return string
     */
    public function getVersionsUrl(): string;

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void;

    /**
     * @param string $id
     * @return void
     */
    public function setId(string $id): void;

    /**
     * @param string $description
     * @return void
     */
    public function setDescription(string $description): void;

    /**
     * @param bool $isArchived
     * @return void
     */
    public function setArchived(bool $isArchived): void;

    /**
     * @param string $lead
     * @return void
     */
    public function setLead(string $lead): void;

    /**
     * @param int $startingNumber
     * @return void
     */
    public function setStartingNumber(int $startingNumber): void;

    /**
     * @param string $url
     * @return void
     */
    public function setUrl(string $url): void;

    /**
     * @param string $assigneesUrl
     * @return void
     */
    public function setAssigneesUrl(string $assigneesUrl): void;

    /**
     * @param string $subsystemsUrl
     * @return void
     */
    public function setSubsystemsUrl(string $subsystemsUrl): void;

    /**
     * @param string $buildsUrl
     * @return void
     */
    public function setBuildsUrl(string $buildsUrl): void;

    /**
     * @param string $versionsUrl
     * @return void
     */
    public function setVersionsUrl(string $versionsUrl): void;
}
