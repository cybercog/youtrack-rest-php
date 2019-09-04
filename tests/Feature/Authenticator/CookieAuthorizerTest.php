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

namespace Cog\YouTrack\Rest\Tests\Feature\Authorizer;

use Cog\YouTrack\Rest\Authenticator\CookieAuthenticator;
use Cog\Contracts\YouTrack\Rest\Authenticator\Exceptions\AuthenticationException;
use Cog\YouTrack\Rest\Authorizer\CookieAuthorizer;
use Cog\YouTrack\Rest\Client\YouTrackClient;
use Cog\YouTrack\Rest\HttpClient\GuzzleHttpClient;
use Cog\YouTrack\Rest\Tests\FeatureTestCase;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;

/**
 * Class CookieAuthorizerTest.
 *
 * @package Cog\YouTrack\Tests\Feature\Authorizer
 */
class CookieAuthorizerTest extends FeatureTestCase
{
    /** @test */
    public function it_throws_exception_on_failed_cookie_authentication()
    {
        $mock = new MockHandler([
            $this->createFakeResponse(403, 'incorrect-login'),
        ]);
        $handler = HandlerStack::create($mock);
        $httpClient = new GuzzleHttpClient(new HttpClient(['handler' => $handler]));
        $authenticator = new CookieAuthenticator('invalid-user', 'invalid-pass');
        $authorizer = new CookieAuthorizer($authenticator);
        $client = new YouTrackClient($httpClient, $authorizer);

        $this->expectException(AuthenticationException::class);

        $client->get('/admin/project');
    }

    /** @todo test */
    public function it_can_successfully_authenticate()
    {
        $http = new GuzzleHttpClient(new HttpClient([
            'base_uri' => 'http://localhost',
        ]));
        $authenticator = new CookieAuthenticator('valid-user', 'valid-pass');
        $authorizer = new CookieAuthorizer($authenticator);

        $this->expectException(AuthenticationException::class);

        new YouTrackClient($http, $authorizer);
    }
}
