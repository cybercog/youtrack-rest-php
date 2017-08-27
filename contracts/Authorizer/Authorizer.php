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

namespace Cog\Contracts\YouTrack\Rest\Authorizer;

use Cog\Contracts\YouTrack\Rest\Client\Client as ClientContract;

/**
 * Interface Authorizer.
 *
 * @package Cog\Contracts\YouTrack\Rest\Authorizer
 */
interface Authorizer
{
    /**
     * Returns authorization headers.
     *
     * @param \Cog\Contracts\YouTrack\Rest\Client\Client $client
     * @return void
     */
    public function appendHeadersTo(ClientContract $client): void;
}
