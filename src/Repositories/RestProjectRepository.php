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

use Cog\YouTrack\Contracts\ProjectRepository as ProjectRepositoryContract;
use Cog\YouTrack\Contracts\ApiClient as ApiClientContract;
use Cog\YouTrack\Entity\Project\Project;
use Cog\YouTrack\Mappers\ProjectResponseMapper;

/**
 * Class RestProjectRepository.
 *
 * @package Cog\YouTrack\Repositories
 */
class RestProjectRepository implements ProjectRepositoryContract
{
    /**
     * @var \Cog\YouTrack\Contracts\ApiClient
     */
    private $youTrack;

    /**
     * @param \Cog\YouTrack\Contracts\ApiClient $youTrack
     */
    public function __construct(ApiClientContract $youTrack)
    {
        $this->youTrack = $youTrack;
    }

    /**
     * Get all accessible projects.
     *
     * @see https://www.jetbrains.com/help/youtrack/standalone/2017.2/GET-Projects.html
     *
     * @return \Cog\YouTrack\Entity\Project\Project[]
     */
    public function all(): array
    {
        // Create QueryObject\RequestMapper

        // Pass QueryObject to API Client
        $response = $this->youTrack->get('/rest/admin/project');

        $mapper = new ProjectResponseMapper(new Project());

        return $mapper->index($response);
    }

    /**
     * Get project by its project identifier.
     *
     * @see https://www.jetbrains.com/help/youtrack/standalone/2017.2/GET-Project.html
     *
     * @param string $id
     * @return \Cog\YouTrack\Entity\Project\Project
     */
    public function find(string $id): Project
    {
        $response = $this->youTrack->get('/rest/admin/project/' . $id);

        $mapper = new ProjectResponseMapper(new Project());

        return $mapper->item($response);
    }

    /**
     * Create new project.
     *
     * @see https://www.jetbrains.com/help/youtrack/standalone/2017.2/PUT-Project.html
     *
     * @param string $id
     * @param array $attributes
     * @return void
     */
    public function create(string $id, array $attributes): void
    {
        $this->youTrack->put('/rest/admin/project/' . $id, $attributes);
    }

    /**
     * Delete specified project.
     *
     * @see https://www.jetbrains.com/help/youtrack/standalone/2017.2/DELETE-Project.html
     *
     * @param string $id
     * @return void
     */
    public function delete(string $id): void
    {
        $this->youTrack->delete('/rest/admin/project/' . $id);
    }
}
