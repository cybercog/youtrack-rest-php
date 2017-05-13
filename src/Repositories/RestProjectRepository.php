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
use Cog\YouTrack\Contracts\YouTrackClient as YouTrackClientContract;
use Cog\YouTrack\Entity\Project\Project;

/**
 * Class RestProjectRepository.
 *
 * @package Cog\YouTrack\Repositories
 */
class RestProjectRepository implements ProjectRepositoryContract
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
     * Get all accessible projects.
     *
     * @see https://www.jetbrains.com/help/youtrack/standalone/2017.2/GET-Projects.html
     *
     * @return \Cog\YouTrack\Entity\Project\Project[]
     */
    public function all(): array
    {
        $response = $this->youTrack->get('/rest/admin/project');

        $projects = [];
        $projectsData = $response->toArray();

        foreach ($projectsData as $projectData) {
            $project = new Project();
            $project->fill($projectData);

            $projects[] = $project;
        }

        return $projects;
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

        $project = new Project();
        $project->fill($response->toArray());

        return $project;
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
