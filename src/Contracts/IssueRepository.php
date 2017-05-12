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
 * Class IssueRepository.
 *
 * @package Cog\YouTrack\Contracts
 */
interface IssueRepository
{
    /**
     * Get issue by id.
     *
     * @see https://www.jetbrains.com/help/youtrack/standalone/2017.2/Get-an-Issue.html
     *
     * @param string $id
     * @return \Cog\YouTrack\Entity\Issue\Issue
     */
    public function find($id);
}
