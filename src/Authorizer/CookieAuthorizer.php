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

namespace Cog\YouTrack\Rest\Authorizer;

use Cog\Contracts\YouTrack\Rest\Authenticator\Authenticator as AuthenticatorContract;
use Cog\Contracts\YouTrack\Rest\Authorizer\Authorizer as AuthorizerContract;
use Cog\Contracts\YouTrack\Rest\Client\Client as ClientContract;

/**
 * Class CookieAuthorizer.
 *
 * @package Cog\YouTrack\Rest\Authorizer
 */
class CookieAuthorizer implements AuthorizerContract
{
    /**
     * @var \Cog\Contracts\YouTrack\Rest\Authenticator\Authenticator
     */
    private $authenticator;

    /**
     * CookieAuthorizer constructor.
     *
     * @param \Cog\Contracts\YouTrack\Rest\Authenticator\Authenticator $authenticator
     */
    public function __construct(AuthenticatorContract $authenticator)
    {
        $this->authenticator = $authenticator;
    }

    /**
     * Append authorization headers to REST client.
     *
     * @param \Cog\Contracts\YouTrack\Rest\Client\Client $client
     * @return void
     *
     * @throws \Cog\Contracts\YouTrack\Rest\Authenticator\Exceptions\AuthenticationException
     */
    public function appendHeadersTo(ClientContract $client): void
    {
        $this->authenticator->authenticate($client);

        $client->withHeader('Cookie', $this->authenticator->token());
    }
}
