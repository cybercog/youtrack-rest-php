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

use Cog\YouTrack\Entity\Issue\Issue;

/**
 * Class IssueRepository.
 *
 * @package Cog\YouTrack\Contracts
 */
interface IssueRepository
{
    /**
     * Get issue by id.
     *
     * @param string $id
     * @return \Cog\YouTrack\Entity\Issue\Issue
     */
    public function find(string $id): Issue;

    /**
     * Report a new issue to YouTrack.
     *
     * @param array $attributes
     * @return void
     */
    public function create(array $attributes): void;

    /**
     * Update summary and description for an issue specified by its `issueID`.
     *
     * @param string $id
     * @param array $attributes
     * @return void
     */
    public function update(string $id, array $attributes): void;

    /**
     * Check that an issue exists.
     *
     * @param string $id
     * @return bool
     */
    public function exists(string $id): bool;
}
