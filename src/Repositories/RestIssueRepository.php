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
 * Class RestIssueRepository.
 *
 * @package Cog\YouTrack\Repositories
 */
class RestIssueRepository implements IssueRepositoryContract
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
    public function find(string $id): Issue
    {
        $response = $this->youTrack->get('/rest/issue/' . $id);

        $issue = new Issue();
        $issue->fill($response->toArray());

        return $issue;
    }

    /**
     * Report a new issue to YouTrack.
     *
     * @see https://www.jetbrains.com/help/youtrack/standalone/2017.2/Create-New-Issue.html
     *
     * @param array $attributes
     * @return void
     */
    public function create(array $attributes): void
    {
        $this->youTrack->put('/rest/issue', $attributes);
        // TODO: Do we need to check $response->getStatusCode() === 201 here?
        // TODO: Do we need to use $response->getLocation() here?
    }

    /**
     * Update summary and description for an issue specified by its `issueID`.
     *
     * @see https://www.jetbrains.com/help/youtrack/standalone/2017.2/Update-an-Issue.html
     *
     * @param string $id
     * @param array $attributes
     * @return void
     */
    public function update(string $id, array $attributes): void
    {
        $this->youTrack->post('/rest/issue/' . $id, $attributes);
    }

    /**
     * Check that an issue exists.
     *
     * @see https://www.jetbrains.com/help/youtrack/standalone/2017.2/Check-that-an-Issue-Exists.html
     *
     * @param string $id
     * @return bool
     */
    public function exists(string $id): bool
    {
        try {
            $response = $this->youTrack->get('/rest/issue/' . $id . '/exists');

            return $response->getStatusCode() === 200;
        } catch (\Throwable $e) {
            return false;
        }
    }
}
