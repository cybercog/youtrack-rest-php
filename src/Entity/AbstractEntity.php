<?php

namespace Cog\YouTrack\Entity;

use InvalidArgumentException;

abstract class AbstractEntity
{
    /**
     * Map the setting of non-existing fields to a mutator when
     * possible, otherwise use the matching field.
     *
     * @param string $name
     * @param mixed $value
     * @return $this
     */
    public function __set(string $name, mixed $value)
    {
        $field = '_' . strtolower($name);

        if (!property_exists($this, $field)) {
            throw new InvalidArgumentException(
                "Setting the field '{$field}' is not valid for this entity.");
        }

        $mutator = 'set' . ucfirst(strtolower($name));
        if (method_exists($this, $mutator) && is_callable([$this, $mutator])) {
            $this->$mutator($value);
        } else {
            $this->$field = $value;
        }

        return $this;
    }

    /**
     * Map the getting of non-existing properties to an accessor when
     * possible, otherwise use the matching field.
     *
     * @param string $name
     * @return mixed
     */
    public function __get(string $name): mixed
    {
        $field = '_' . strtolower($name);

        if (!property_exists($this, $field)) {
            throw new InvalidArgumentException("Getting the field '{$field}' is not valid for this entity.");
        }

        $accessor = 'get' . ucfirst(strtolower($name));
        return (method_exists($this, $accessor) && is_callable([$this, $accessor])) ? $this->$accessor() : $this->field;
    }

    /**
     * Get the entity fields.
     *
     * @return array
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
