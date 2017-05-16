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

use ArrayAccess;
use Countable;
use IteratorAggregate;
use Cog\YouTrack\Contracts\Project as ProjectContract;
use JsonSerializable;

/**
 * Interface ProjectCollection.
 *
 * @package Cog\YouTrack\Contracts
 */
interface ProjectCollection extends ArrayAccess, Arrayable, Countable, IteratorAggregate, Jsonable, JsonSerializable
{
    public function all(): array;

    public function add(ProjectContract $user): void;

    public function remove(ProjectContract $user): void;

    public function get($key);

    public function has($key): bool;

    public function clear(): void;

    public function toArray(): array;
}
