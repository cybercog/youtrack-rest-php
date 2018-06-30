<?php

declare(strict_types=1);

/*
 * This file is part of PHP YouTrack REST.
 *
 * (c) Anton Komarev <a.komarev@cybercog.su>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cog\YouTrack\Rest\Tests;

use Cog\YouTrack\Rest\Authorizer\TokenAuthorizer;
use Cog\YouTrack\Rest\Client\YouTrackClient;
use Cog\YouTrack\Rest\HttpClient\GuzzleHttpClient;
use Cog\YouTrack\Rest\Tests\Traits\HasFakeHttpResponses;
use GuzzleHttp\Client as HttpClient;

/**
 * Class TestCase.
 *
 * @package Cog\YouTrack\Rest\Tests
 */
abstract class FeatureTestCase extends TestCase
{
    use HasFakeHttpResponses;

    protected function initializeClient(): YouTrackClient
    {
        $http = new GuzzleHttpClient(new HttpClient([
            'base_uri' => env('YOUTRACK_BASE_URI'),
        ]));
        $authorizer = new TokenAuthorizer(env('YOUTRACK_TOKEN'));

        return new YouTrackClient($http, $authorizer);
    }

    protected function stubsPath($path): string
    {
        return realpath(__DIR__ . '/stubs/' . $path);
    }
}
