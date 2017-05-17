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

use Cog\YouTrack\Contracts\Project as ProjectContract;
use Cog\YouTrack\Contracts\ProjectCollection as ProjectCollectionContract;

/**
 * Interface ProjectMapper.
 *
 * @package Cog\YouTrack\Contracts
 */
interface ProjectMapper
{
    public function fetchById(string $id): ProjectContract;

    public function fetchAll(array $conditions = []): ProjectCollectionContract;
}
