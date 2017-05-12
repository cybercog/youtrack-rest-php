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

namespace Cog\YouTrack\Entity\Issue;

/**
 * YouTrack Issue Field Entity.
 *
 * @package Cog\YouTrack\Entity\Issue
 */
class Field
{
    /**
     * Issue Field name.
     *
     * @var string
     */
    private $name;

    /**
     * Collection of field values.
     *
     * @var array
     */
    private $values = [];

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getValues(): array
    {
        return $this->values;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param array $values
     * @return void
     */
    public function setValues(array $values): void
    {
        $this->values = $values;
    }
}
