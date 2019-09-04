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

// Boot third party libraries
require_once __DIR__ . '/../vendor/autoload.php';

use Cog\YouTrack\Rest;

// Application configuration (replace with your YouTrack server values)
$apiBaseUri = 'https://write-youtrack-domain.here';
$apiToken = 'YOUTRACK_PERMANENT_TOKEN';

// Instantiate PSR-7 HTTP Client
$psrHttpClient = new \GuzzleHttp\Client([
    'base_uri' => $apiBaseUri,
    'debug' => true,
]);

// Instantiate YouTrack API HTTP Client
$httpClient = new Rest\HttpClient\GuzzleHttpClient($psrHttpClient);

// Instantiate YouTrack API Token Authorizer
$authorizer = new Rest\Authorizer\TokenAuthorizer($apiToken);

// Instantiate YouTrack API Client
$client = new Rest\Client\YouTrackClient($httpClient, $authorizer);

// Do request to the API
$response = $client->get('/admin/project');

// Convert response to array
$projects = $response->toArray();

// Render projects one by one
echo 'Project list:';
foreach ($projects as $project) {
    echo ' #' . $project['id'];
}
