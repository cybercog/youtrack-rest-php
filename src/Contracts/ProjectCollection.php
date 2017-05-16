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
    /**
     * Create a new collection instance if the value isn't one already.
     *
     * @param mixed $items
     * @return static
     */
    public static function make(array $items = []): self;

    /**
     * Get all of the items in the collection.
     *
     * @return array
     */
    public function all(): array;

    /**
     * Add project to collection.
     *
     * @param \Cog\YouTrack\Contracts\Project $project
     */
    public function add(ProjectContract $project): void;

    /**
     * Remove project from the collection.
     *
     * @param \Cog\YouTrack\Contracts\Project $project
     */
    public function remove(ProjectContract $project): void;

    /**
     * Get an item from the collection by key.
     *
     * @param mixed $key
     * @param mixed $default
     * @return mixed
     */
    public function get($key, $default = null);

    /**
     * Determine if an item exists in the collection by key.
     *
     * @param mixed $key
     * @return bool
     */
    public function has($key): bool;

    /**
     * Remove all items from the collection.
     *
     * @return void
     */
    public function clear(): void;

    /**
     * Get the collection of items as a plain array.
     *
     * @return array
     */
    public function toArray(): array;
}
