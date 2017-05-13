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

use Cog\YouTrack\Entity\Project\Project;

/**
 * Class RestProjectRepository.
 *
 * @package Cog\YouTrack\Contracts
 */
interface ProjectRepository
{
    /**
     * Get all accessible projects.
     *
     * @return \Cog\YouTrack\Entity\Project\Project[]
     */
    public function all(): array;

    /**
     * Get project by its project identifier.
     *
     * @param string $id
     * @return \Cog\YouTrack\Entity\Project\Project
     */
    public function find(string $id): Project;

    /**
     * Create new project.
     *
     * @param string $id
     * @param array $attributes
     * @return void
     */
    public function create(string $id, array $attributes): void;

    /**
     * Delete specified project.
     *
     * @param string $id
     * @return void
     */
    public function delete(string $id): void;
}
