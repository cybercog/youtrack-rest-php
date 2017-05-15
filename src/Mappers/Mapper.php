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

use Cog\YouTrack\Contracts\ApiResponse as ApiResponseContract;
use Cog\YouTrack\Entity\Project\Project;

/**
 * Class Mapper.
 *
 * @package Cog\YouTrack\Mappers
 */
abstract class Mapper
{
    /**
     * @var
     */
    protected $entity;

    /**
     * @var array
     */
    protected $items = [];

    /**
     * Mapper constructor.
     *
     * @param $entity
     */
    public function __construct($entity)
    {
        $this->entity = $entity;
    }

    /**
     * @param \Cog\YouTrack\Contracts\ApiResponse $response
     * @return array
     */
    public function index(ApiResponseContract $response): array
    {
        foreach ($response->toArray() as $itemData) {
            $this->items[] = $this->newInstance($itemData);
        }

        return $this->items;
    }

    /**
     * @param \Cog\YouTrack\Contracts\ApiResponse $response
     */
    public function item(ApiResponseContract $response)
    {
        return $this->newInstance($response->toArray());
    }

    abstract protected function newInstance(array $data);
}
