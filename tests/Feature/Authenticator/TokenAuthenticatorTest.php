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

use Cog\YouTrack\Rest\Authenticator\Exceptions\InvalidTokenException;
use Cog\YouTrack\Rest\Authenticator\TokenAuthenticator;
use Cog\YouTrack\Rest\Client\YouTrackClient;
use Cog\YouTrack\Rest\Tests\FeatureTestCase;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;

/**
 * Class TokenAuthenticatorTest.
 *
 * @package Cog\YouTrack\Tests\Feature\Authenticator
 */
class TokenAuthenticatorTest extends FeatureTestCase
{
    /** @test */
    public function it_throws_exception_on_failed_token_authentication()
    {
        $mock = new MockHandler([
            $this->createFakeResponse(401, 'unauthorized'),
        ]);
        $handler = HandlerStack::create($mock);
        $http = new HttpClient(['handler' => $handler]);
        $authenticator = new TokenAuthenticator([
            'token' => 'invalid-token',
        ]);

        $this->expectException(InvalidTokenException::class);

        $client = new YouTrackClient($http, $authenticator);
        $client->get('/admin/project');
    }
}
