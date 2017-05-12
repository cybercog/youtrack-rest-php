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

use Cog\YouTrack\Contracts\YouTrackClient as YouTrackClientContract;
use Cog\YouTrack\Entity\Project\Project;

/**
 * Class ProjectRepository.
 *
 * @package Cog\YouTrack\Contracts
 */
interface ProjectRepository
{
    /**
     * @see https://www.jetbrains.com/help/youtrack/standalone/2017.2/GET-Projects.html
     *
     * @return \Cog\YouTrack\Entity\Project\Project[]
     */
    public function all();

    /**
     * @see https://www.jetbrains.com/help/youtrack/standalone/2017.2/GET-Project.html
     *
     * @param string $id
     * @return \Cog\YouTrack\Entity\Project\Project
     */
    public function find($id);
}
