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

// Boot third party libraries
require_once __DIR__ . '/../vendor/autoload.php';

// Application configuration (replace with your YouTrack server values)
$apiBaseUri = 'https://write-youtrack-domain.here';
$apiUsername = 'YOUR_USERNAME';
$apiPassword = 'YOUR_PASSWORD';

// Instantiate HTTP Client
$http = new \GuzzleHttp\Client([
    'base_uri' => $apiBaseUri,
]);

// Instantiate YouTrack API Cookie Authenticator
$authenticator = new \Cog\YouTrack\Rest\Authenticator\CookieAuthenticator($apiUsername, $apiPassword);

// Instantiate YouTrack API Cookie Authorizer
$authorizer = new \Cog\YouTrack\Rest\Authorizer\CookieAuthorizer($authenticator);

// Instantiate YouTrack API Client
$client = new \Cog\YouTrack\Rest\Client\YouTrackClient($http, $authorizer);

// Do request to the API
$response = $client->get('/admin/project');

// Convert response to array
$projects = $response->toArray();

// Render projects one by one
echo 'Project list:';
foreach ($projects as $project) {
    echo ' #' . $project['id'];
}
