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

namespace Cog\YouTrack\Entity\Project;

use ArrayIterator;
use Cog\YouTrack\Contracts\Project as ProjectContract;
use Cog\YouTrack\Contracts\ProjectCollection as ProjectCollectionContract;
use Cog\YouTrack\Contracts\Arrayable;
use Cog\YouTrack\Contracts\Jsonable;
use JsonSerializable;
use Traversable;

/**
 * YouTrack ProjectCollection Entity.
 *
 * @package Cog\YouTrack\Entity\Project
 */
class ProjectCollection implements ProjectCollectionContract
{
    /**
     * The items contained in the collection.
     *
     * @var array
     */
    private $items = [];

    /**
     * Create a new collection.
     *
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * Create a new collection instance if the value isn't one already.
     *
     * @param mixed $items
     * @return static
     */
    public static function make(array $items = []): ProjectCollectionContract
    {
        return new static($items);
    }

    /**
     * Get all of the items in the collection.
     *
     * @return array
     */
    public function all(): array
    {
        return $this->items;
    }

    /**
     * Add project to collection.
     *
     * @param \Cog\YouTrack\Contracts\Project $project
     */
    public function add(ProjectContract $project): void
    {
        $this->offsetSet(null, $project);
    }

    /**
     * Remove project from the collection.
     *
     * @param \Cog\YouTrack\Contracts\Project $project
     */
    public function remove(ProjectContract $project): void
    {
        $this->offsetUnset($project);
    }

    /**
     * Get an item from the collection by key.
     *
     * @param mixed $key
     * @param mixed $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        if ($this->offsetExists($key)) {
            return $this->offsetGet($key);
        }

        return $default;
    }

    /**
     * Determine if an item exists in the collection by key.
     *
     * @param mixed $key
     * @return bool
     */
    public function has($key): bool
    {
        return $this->offsetExists($key);
    }

    /**
     * Remove all items from the collection.
     *
     * @return void
     */
    public function clear(): void
    {
        $this->items = [];
    }

    /**
     * Get the collection of items as a plain array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return array_map(function ($value) {
            return $value instanceof Arrayable ? $value->toArray() : $value;
        }, $this->items);
    }

    /**
     * Get the collection of items as JSON.
     *
     * @param int $options
     * @return string
     */
    public function toJson(int $options = 0): string
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return array_map(function ($value) {
            if ($value instanceof JsonSerializable) {
                return $value->jsonSerialize();
            } elseif ($value instanceof Jsonable) {
                return json_decode($value->toJson(), true);
            } elseif ($value instanceof Arrayable) {
                return $value->toArray();
            } else {
                return $value;
            }
        }, $this->items);
    }

    /**
     * Offset to set.
     *
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param null|string $key The offset to assign the value to.
     * @param mixed $value The value to set.
     * @return void
     */
    public function offsetSet($key, $value): void
    {
        if (!$value instanceof ProjectContract) {
            throw new \InvalidArgumentException(
                'Could not add item to the collection.'
            );
        }
        if (!isset($key)) {
            $this->items[] = $value;
        } else {
            $this->items[$key] = $value;
        }
    }

    /**
     * Offset to unset.
     *
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $key The offset to unset.
     * @return void
     */
    public function offsetUnset($key): void
    {
        if ($key instanceof ProjectContract) {
            $this->items = array_filter($this->items,
                function ($item) use ($key) {
                    return $item !== $key;
                });
        } elseif (isset($this->items[$key])) {
            unset($this->items[$key]);
        }
    }

    /**
     * Offset to retrieve.
     *
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $key The offset to retrieve.
     * @return mixed Can return all value types.
     */
    public function offsetGet($key)
    {
        if (isset($this->items[$key])) {
            return $this->items[$key];
        }
    }

    /**
     * Whether a offset exists.
     *
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $key An offset to check for.
     * @return bool true on success or false on failure.
     */
    public function offsetExists($key): bool
    {
        return boolval(($key instanceof ProjectContract)
            ? array_search($key, $this->items, true)
            : isset($this->items[$key]));
    }

    /**
     * Retrieve an external iterator.
     *
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return \Traversable An instance of an object implementing `Iterator` or `Traversable`
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    /**
     * Count elements of an object.
     *
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     */
    public function count(): int
    {
        return count($this->items);
    }

    /**
     * Convert the collection to its string representation.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toJson();
    }
}
