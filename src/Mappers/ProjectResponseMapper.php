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

namespace Cog\YouTrack\Mappers;

use Cog\YouTrack\Entity\Project\Project;

/**
 * Class ProjectResponseMapper.
 *
 * @package Cog\YouTrack\Mappers
 */
class ProjectResponseMapper extends Mapper
{
    /**
     * @param array $data
     * @return \Cog\YouTrack\Entity\Project\Project
     */
    protected function newInstance(array $data): Project
    {
        $entity = new $this->entity;
        $entity->fill($data);

        return $entity;
    }
}
