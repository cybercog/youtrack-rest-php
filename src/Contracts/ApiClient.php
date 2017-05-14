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

use Cog\YouTrack\Contracts\ApiAuthenticator as ApiAuthenticatorContract;
use Cog\YouTrack\Contracts\ApiResponse as ApiResponseContract;

/**
 * Interface ApiClient.
 *
 * @package Cog\YouTrack\Contracts
 */
interface ApiClient
{
    /**
     * Set authentication strategy.
     *
     * @param \Cog\YouTrack\Contracts\ApiAuthenticator $authenticator
     * @return void
     */
    public function setAuthenticator(ApiAuthenticatorContract $authenticator): void;

    /**
     * Get authentication strategy.
     *
     * @return \Cog\YouTrack\Contracts\ApiAuthenticator
     */
    public function getAuthenticator(): ApiAuthenticatorContract;

    /**
     * Create and send an HTTP request.
     *
     * @param string $method
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Contracts\ApiResponse
     */
    public function request(string $method, string $uri, array $formData = []) : ApiResponseContract;

    /**
     * Create and send an GET HTTP request.
     *
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Contracts\ApiResponse
     */
    public function get(string $uri, array $formData = []): ApiResponseContract;

    /**
     * Create and send an POST HTTP request.
     *
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Contracts\ApiResponse
     */
    public function post(string $uri, array $formData = []): ApiResponseContract;

    /**
     * Create and send an PUT HTTP request.
     *
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Contracts\ApiResponse
     */
    public function put(string $uri, array $formData = []): ApiResponseContract;

    /**
     * Create and send an DELETE HTTP request.
     *
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Contracts\ApiResponse
     */
    public function delete(string $uri, array $formData = []): ApiResponseContract;
}
