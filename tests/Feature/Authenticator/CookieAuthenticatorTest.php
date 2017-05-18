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

namespace Cog\YouTrack\Rest\Tests\Feature\Authenticator;

use Cog\YouTrack\Rest\Authenticator\CookieAuthenticator;
use Cog\YouTrack\Rest\Authenticator\Exceptions\AuthenticationException;
use Cog\YouTrack\Rest\Client\YouTrackClient;
use Cog\YouTrack\Rest\Tests\FeatureTestCase;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;

/**
 * Class CookieAuthenticatorTest.
 *
 * @package Cog\YouTrack\Tests\Feature\Authenticator
 */
class CookieAuthenticatorTest extends FeatureTestCase
{
    /** @test */
    public function it_throws_exception_on_failed_cookie_authentication()
    {
        $mock = new MockHandler([
            $this->createFakeResponse(403, 'incorrect-login'),
        ]);
        $handler = HandlerStack::create($mock);
        $http = new HttpClient(['handler' => $handler]);
        $authenticator = new CookieAuthenticator([
            'username' => 'invalid-user',
            'password' => 'invalid-pass',
        ]);

        $this->expectException(AuthenticationException::class);

        new YouTrackClient($http, $authenticator);
    }

    /** @todo test */
    public function it_can_successfully_authenticate()
    {
        $http = new HttpClient([
            'base_uri' => 'http://localhost'
        ]);
        $authenticator = new CookieAuthenticator([
            'username' => 'invalid-user',
            'password' => 'invalid-pass',
        ]);

        $this->expectException(AuthenticationException::class);

        new YouTrackClient($http, $authenticator);
    }
}
