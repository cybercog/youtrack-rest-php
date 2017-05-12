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

namespace Cog\YouTrack\Traits;

trait HasHydrator
{
    /**
     * Hydrate entity with attributes.
     *
     * @param array $attributes
     * @return void
     */
    public function hydrate(array $attributes)
    {
        foreach ($attributes as $attributeKey => $attributeValue) {
            if (is_null($attributeValue)) {
                continue;
            }

            $method = 'set' . ucfirst($attributeKey);
            if (!method_exists($this, $method)) {
                continue;
            }

            $this->{$method}($attributeValue);
        }
    }
}
