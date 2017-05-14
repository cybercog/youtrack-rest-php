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

use Cog\YouTrack\Contracts\RestAuthenticator as RestAuthenticatorContract;
use Cog\YouTrack\Contracts\YouTrackRestResponse as YouTrackRestResponseContract;

/**
 * Interface YouTrackClient.
 *
 * @package Cog\YouTrack\Contracts
 */
interface YouTrackClient
{
    /**
     * Set authentication strategy.
     *
     * @param \Cog\YouTrack\Contracts\RestAuthenticator $authenticator
     * @return void
     */
    public function setAuthenticator(RestAuthenticatorContract $authenticator): void;

    /**
     * Get authentication strategy.
     *
     * @return \Cog\YouTrack\Contracts\RestAuthenticator
     */
    public function getAuthenticator(): RestAuthenticatorContract;

    /**
     * Create and send an HTTP request.
     *
     * @param string $method
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Contracts\YouTrackRestResponse
     */
    public function request(string $method, string $uri, array $formData = []) : YouTrackRestResponseContract;

    /**
     * Create and send an GET HTTP request.
     *
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Contracts\YouTrackRestResponse
     */
    public function get(string $uri, array $formData = []): YouTrackRestResponseContract;

    /**
     * Create and send an POST HTTP request.
     *
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Contracts\YouTrackRestResponse
     */
    public function post(string $uri, array $formData = []): YouTrackRestResponseContract;

    /**
     * Create and send an PUT HTTP request.
     *
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Contracts\YouTrackRestResponse
     */
    public function put(string $uri, array $formData = []): YouTrackRestResponseContract;

    /**
     * Create and send an DELETE HTTP request.
     *
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Contracts\YouTrackRestResponse
     */
    public function delete(string $uri, array $formData = []): YouTrackRestResponseContract;
}
