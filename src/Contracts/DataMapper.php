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

/**
 * Interface DataMapper.
 *
 * @package Cog\YouTrack\Contracts
 */
interface DataMapper
{
    public function all();

    public function first(array $conditions = []);

    public function save();

    public function update();

    public function delete();
}
