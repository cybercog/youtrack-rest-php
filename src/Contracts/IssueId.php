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
 * Interface IssueId.
 *
 * @package Cog\YouTrack\Entity\Issue
 */
interface IssueId
{
    /**
     * Instantiate IssueId object from the string representation.
     *
     * @param string $id
     * @return \Cog\YouTrack\Contracts\IssueId
     */
    public static function fromString(string $id): self;

    /**
     * Represent IssueId as string value.
     *
     * @return string
     */
    public function __toString(): string;
}
