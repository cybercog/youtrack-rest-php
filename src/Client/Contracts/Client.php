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

namespace Cog\YouTrack\Rest\Client\Contracts;

use Cog\YouTrack\Rest\Authorizer\Contracts\Authorizer as AuthorizerContract;
use Cog\YouTrack\Rest\Response\Contracts\Response as ResponseContract;

/**
 * Interface Client.
 *
 * @package Cog\YouTrack\Rest\Client\Contracts
 */
interface Client
{
    /**
     * Set authorization strategy.
     *
     * @param \Cog\YouTrack\Rest\Authorizer\Contracts\Authorizer $authorizer
     * @return void
     */
    public function setAuthorizer(AuthorizerContract $authorizer): void;

    /**
     * Get authorization strategy.
     *
     * @return \Cog\YouTrack\Rest\Authorizer\Contracts\Authorizer
     */
    public function getAuthorizer(): AuthorizerContract;

    /**
     * Create and send an HTTP request.
     *
     * @param string $method
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Rest\Response\Contracts\Response
     *
     * @throws \Cog\YouTrack\Rest\Authorizer\Exceptions\AuthenticationException
     * @throws \Cog\YouTrack\Rest\Authorizer\Exceptions\InvalidTokenException
     */
    public function request(string $method, string $uri, array $formData = []) : ResponseContract;

    /**
     * Create and send an GET HTTP request.
     *
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Rest\Response\Contracts\Response
     */
    public function get(string $uri, array $formData = []): ResponseContract;

    /**
     * Create and send an POST HTTP request.
     *
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Rest\Response\Contracts\Response
     */
    public function post(string $uri, array $formData = []): ResponseContract;

    /**
     * Create and send an PUT HTTP request.
     *
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Rest\Response\Contracts\Response
     */
    public function put(string $uri, array $formData = []): ResponseContract;

    /**
     * Create and send an DELETE HTTP request.
     *
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Rest\Response\Contracts\Response
     */
    public function delete(string $uri, array $formData = []): ResponseContract;
}
