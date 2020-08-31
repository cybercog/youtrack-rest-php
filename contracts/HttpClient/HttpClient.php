<?php

declare(strict_types=1);

/*
 * This file is part of PHP YouTrack REST.
 *
 * (c) Anton Komarev <anton@komarev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cog\Contracts\YouTrack\Rest\HttpClient;

use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

interface HttpClient
{
    /**
     * Send request to the server and fetch the raw response.
     *
     * @param string $method Request Method
     * @param string $uri URI/Endpoint to send the request to
     * @param array $options Additional Options
     * @return \Psr\Http\Message\ResponseInterface Raw response from the server
     *
     * @throws \Cog\Contracts\YouTrack\Rest\HttpClient\Exceptions\HttpClientException
     */
    public function request(string $method, string $uri, array $options = []): PsrResponseInterface;
}
