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

namespace Cog\YouTrack\Repositories;

use Cog\YouTrack\Contracts\IssueRepository as IssueRepositoryContract;
use Cog\YouTrack\Contracts\YouTrackClient as YouTrackClientContract;
use Cog\YouTrack\Entity\Issue\Issue;

/**
 * Class IssueRepository.
 *
 * @package Cog\YouTrack\Repositories
 */
class IssueRepository implements IssueRepositoryContract
{
    /**
     * @var \Cog\YouTrack\Contracts\YouTrackClient
     */
    private $youTrack;

    /**
     * @param \Cog\YouTrack\Contracts\YouTrackClient $youTrack
     */
    public function __construct(YouTrackClientContract $youTrack)
    {
        $this->youTrack = $youTrack;
    }

    /**
     * Get issue by id.
     *
     * @see https://www.jetbrains.com/help/youtrack/standalone/2017.2/Get-an-Issue.html
     *
     * @param string $id
     * @return \Cog\YouTrack\Entity\Issue\Issue
     */
    public function find($id)
    {
        $issueData = $this->youTrack->get('/rest/issue/' . $id);

        $issue = new Issue();
        $issue->fill($issueData->toArray());

        return $issue;
    }
}
