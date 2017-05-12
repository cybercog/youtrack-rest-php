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

namespace Cog\YouTrack\Services;

use GuzzleHttp\ClientInterface as ClientContract;

/**
 * @see https://www.jetbrains.com/help/youtrack/standalone/2017.2/YouTrack-REST-API-Reference.html
 *
 * @package Cog\YouTrack\Services
 */
class YouTrackClient
{
    /**
     * @var \GuzzleHttp\ClientInterface
     */
    private $http;

    /**
     * @var array
     */
    private $options;

    /**
     * @param \GuzzleHttp\ClientInterface $http
     * @param array $options
     */
    public function __construct(ClientContract $http, array $options = [])
    {
        $this->http = $http;
        $this->options = $options;
    }
}
