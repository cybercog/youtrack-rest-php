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

use Cog\YouTrack\Rest\Response\Contracts\Response as ResponseContract;

/**
 * Interface Client.
 *
 * @package Cog\YouTrack\Rest\Client\Contracts
 */
interface Client
{
    /**
     * Version of YouTrack REST PHP client.
     */
    const VERSION = '3.0.0';

    /**
     * Create and send an HTTP request.
     *
     * @param string $method
     * @param string $uri
     * @param array $formData
     * @param array $options
     * @return \Cog\YouTrack\Rest\Response\Contracts\Response
     *
     * @throws \Cog\YouTrack\Rest\Authenticator\Exceptions\AuthenticationException
     * @throws \Cog\YouTrack\Rest\Authorizer\Exceptions\InvalidTokenException
     * @throws \Cog\YouTrack\Rest\Client\Exceptions\ClientException
     */
    public function request(string $method, string $uri, array $formData = [], array $options = []): ResponseContract;

    /**
     * Create and send an GET HTTP request.
     *
     * @param string $uri
     * @param array $formData
     * @param array $options
     * @return \Cog\YouTrack\Rest\Response\Contracts\Response
     *
     * @throws \Cog\YouTrack\Rest\Authenticator\Exceptions\AuthenticationException
     * @throws \Cog\YouTrack\Rest\Authorizer\Exceptions\InvalidTokenException
     * @throws \Cog\YouTrack\Rest\Client\Exceptions\ClientException
     */
    public function get(string $uri, array $formData = [], array $options = []): ResponseContract;

    /**
     * Create and send an POST HTTP request.
     *
     * @param string $uri
     * @param array $formData
     * @param array $options
     * @return \Cog\YouTrack\Rest\Response\Contracts\Response
     *
     * @throws \Cog\YouTrack\Rest\Authenticator\Exceptions\AuthenticationException
     * @throws \Cog\YouTrack\Rest\Authorizer\Exceptions\InvalidTokenException
     * @throws \Cog\YouTrack\Rest\Client\Exceptions\ClientException
     */
    public function post(string $uri, array $formData = [], array $options = []): ResponseContract;

    /**
     * Create and send an PUT HTTP request.
     *
     * @param string $uri
     * @param array $formData
     * @param array $options
     * @return \Cog\YouTrack\Rest\Response\Contracts\Response
     *
     * @throws \Cog\YouTrack\Rest\Authenticator\Exceptions\AuthenticationException
     * @throws \Cog\YouTrack\Rest\Authorizer\Exceptions\InvalidTokenException
     * @throws \Cog\YouTrack\Rest\Client\Exceptions\ClientException
     */
    public function put(string $uri, array $formData = [], array $options = []): ResponseContract;

    /**
     * Create and send an DELETE HTTP request.
     *
     * @param string $uri
     * @param array $formData
     * @param array $options
     * @return \Cog\YouTrack\Rest\Response\Contracts\Response
     *
     * @throws \Cog\YouTrack\Rest\Authenticator\Exceptions\AuthenticationException
     * @throws \Cog\YouTrack\Rest\Authorizer\Exceptions\InvalidTokenException
     * @throws \Cog\YouTrack\Rest\Client\Exceptions\ClientException
     */
    public function delete(string $uri, array $formData = [], array $options = []): ResponseContract;

    /**
     * Write header value.
     *
     * @param string $key
     * @param string $value
     */
    public function putHeader(string $key, string $value): void;
}
