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

use Cog\YouTrack\Entity\Issue\Issue;

/**
 * Class IssueResponseMapper.
 *
 * @package Cog\YouTrack\Mappers
 */
class IssueResponseMapper extends Mapper
{
    /**
     * @param array $data
     * @return \Cog\YouTrack\Entity\Issue\Issue
     */
    protected function newInstance(array $data): Issue
    {
        $entity = new $this->entity;
        $entity->fill($data);

        return $entity;
    }
}
