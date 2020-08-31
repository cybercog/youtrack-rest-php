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

namespace Cog\Contracts\YouTrack\Rest\Client;

use Cog\Contracts\YouTrack\Rest\Response\Response as ResponseInterface;

interface Client
{
    /**
     * Version of PHP YouTrack REST client.
     */
    public const VERSION = '6.2.3';

    /**
     * Create and send an HTTP request.
     *
     * @param string $method
     * @param string $uri
     * @param array $params
     * @param array $options
     * @return \Cog\Contracts\YouTrack\Rest\Response\Response
     *
     * @throws \Cog\Contracts\YouTrack\Rest\Authenticator\Exceptions\AuthenticationException
     * @throws \Cog\Contracts\YouTrack\Rest\Authorizer\Exceptions\InvalidAuthorizationToken
     * @throws \Cog\Contracts\YouTrack\Rest\Client\Exceptions\ClientException
     */
    public function request(string $method, string $uri, array $params = [], array $options = []): ResponseInterface;

    /**
     * Create and send an GET HTTP request.
     *
     * @param string $uri
     * @param array $params
     * @param array $options
     * @return \Cog\Contracts\YouTrack\Rest\Response\Response
     *
     * @throws \Cog\Contracts\YouTrack\Rest\Authenticator\Exceptions\AuthenticationException
     * @throws \Cog\Contracts\YouTrack\Rest\Authorizer\Exceptions\InvalidAuthorizationToken
     * @throws \Cog\Contracts\YouTrack\Rest\Client\Exceptions\ClientException
     */
    public function get(string $uri, array $params = [], array $options = []): ResponseInterface;

    /**
     * Create and send an POST HTTP request.
     *
     * @param string $uri
     * @param array $params
     * @param array $options
     * @return \Cog\Contracts\YouTrack\Rest\Response\Response
     *
     * @throws \Cog\Contracts\YouTrack\Rest\Authenticator\Exceptions\AuthenticationException
     * @throws \Cog\Contracts\YouTrack\Rest\Authorizer\Exceptions\InvalidAuthorizationToken
     * @throws \Cog\Contracts\YouTrack\Rest\Client\Exceptions\ClientException
     */
    public function post(string $uri, array $params = [], array $options = []): ResponseInterface;

    /**
     * Create and send an PUT HTTP request.
     *
     * @param string $uri
     * @param array $params
     * @param array $options
     * @return \Cog\Contracts\YouTrack\Rest\Response\Response
     *
     * @throws \Cog\Contracts\YouTrack\Rest\Authenticator\Exceptions\AuthenticationException
     * @throws \Cog\Contracts\YouTrack\Rest\Authorizer\Exceptions\InvalidAuthorizationToken
     * @throws \Cog\Contracts\YouTrack\Rest\Client\Exceptions\ClientException
     */
    public function put(string $uri, array $params = [], array $options = []): ResponseInterface;

    /**
     * Create and send an DELETE HTTP request.
     *
     * @param string $uri
     * @param array $params
     * @param array $options
     * @return \Cog\Contracts\YouTrack\Rest\Response\Response
     *
     * @throws \Cog\Contracts\YouTrack\Rest\Authenticator\Exceptions\AuthenticationException
     * @throws \Cog\Contracts\YouTrack\Rest\Authorizer\Exceptions\InvalidAuthorizationToken
     * @throws \Cog\Contracts\YouTrack\Rest\Client\Exceptions\ClientException
     */
    public function delete(string $uri, array $params = [], array $options = []): ResponseInterface;

    /**
     * Write header value.
     *
     * @param string $key
     * @param string $value
     * @return void
     */
    public function withHeader(string $key, string $value): void;

    /**
     * Write header values.
     *
     * @param array $headers
     * @return void
     */
    public function withHeaders(array $headers): void;
}
