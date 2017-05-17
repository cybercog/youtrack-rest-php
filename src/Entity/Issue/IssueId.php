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

use Cog\YouTrack\Contracts\IssueId as IssueIdContract;

/**
 * Class IssueId.
 *
 * @package Cog\YouTrack\Entity\Issue
 */
class IssueId implements IssueIdContract
{
    /**
     * Numeric issue identifier within project.
     *
     * @var int
     */
    private $id;

    /**
     * Project name which issue is related.
     *
     * @var string
     */
    private $projectName;

    /**
     * IssueId constructor.
     *
     * @param string $projectName
     * @param int $id
     */
    public function __construct(string $projectName, int $id)
    {
        $this->projectName = $projectName;
        $this->id = $id;
    }

    /**
     * Instantiate IssueId object from the string representation.
     *
     * @param string $id
     * @return \Cog\YouTrack\Contracts\IssueId
     */
    public static function fromString(string $id): IssueIdContract
    {
        $data = explode('-', $id);

        return new static($data[0], (int) $data[1]);
    }

    /**
     * Represent IssueId as string value.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->projectName . '-' . $this->id;
    }
}
