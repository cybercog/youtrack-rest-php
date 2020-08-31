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

namespace Cog\YouTrack\Rest\Authorizer;

use Cog\Contracts\YouTrack\Rest\Authenticator\Authenticator as AuthenticatorInterface;
use Cog\Contracts\YouTrack\Rest\Authorizer\Authorizer as AuthorizerInterface;
use Cog\Contracts\YouTrack\Rest\Client\Client as ClientInterface;

class CookieAuthorizer implements
    AuthorizerInterface
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
    public function __construct(AuthenticatorInterface $authenticator)
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
    public function appendHeadersTo(ClientInterface $client): void
    {
        $this->authenticator->authenticate($client);

        $client->withHeader('Cookie', $this->authenticator->token());
    }
}
