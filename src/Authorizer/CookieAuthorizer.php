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

use Cog\YouTrack\Rest\Authenticator\Contracts\Authenticator as AuthenticatorContract;
use Cog\YouTrack\Rest\Authorizer\Contracts\Authorizer as AuthorizerContract;
use Cog\YouTrack\Rest\Client\Contracts\Client as ClientContract;

/**
 * Class CookieAuthorizer.
 *
 * @package Cog\YouTrack\Rest\Authorizer
 */
class CookieAuthorizer implements AuthorizerContract
{
    /**
     * @var \Cog\YouTrack\Rest\Authenticator\Contracts\Authenticator
     */
    private $authenticator;

    /**
     * CookieAuthorizer constructor.
     *
     * @param \Cog\YouTrack\Rest\Authenticator\Contracts\Authenticator $authenticator
     */
    public function __construct(AuthenticatorContract $authenticator)
    {
        $this->authenticator = $authenticator;
    }

    /**
     * Returns authorization headers.
     *
     * @param \Cog\YouTrack\Rest\Client\Contracts\Client $client
     * @return void
     */
    public function appendHeadersTo(ClientContract $client): void
    {
        $this->authenticator->authenticate($client);

        $client->putHeader('Cookie', $this->authenticator->getCookie());
    }
}
