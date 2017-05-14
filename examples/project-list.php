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

// Application configuration
$apiBaseUri = 'https://write-youtrack-domain.here';
$apiAuthToken = 'WRITE_YOUR_TOKEN_HERE';

// Instantiate HTTP Client
$http = new \GuzzleHttp\Client([
    'base_uri' => $apiBaseUri,
]);

// Instantiate YouTrack API Authenticator
$authenticator = new \Cog\YouTrack\Rest\Authenticators\TokenAuthenticator([
    'token' => $apiAuthToken,
]);

// Instantiate YouTrack API Client
$client = new \Cog\YouTrack\Rest\YouTrackClient($http, $authenticator);

// Instantiate YouTrack Project Repository
$repository = new \Cog\YouTrack\Repositories\RestProjectRepository($client);

// Fetch all projects
$projects = $repository->all();

echo 'Project list:';
foreach ($projects as $project) {
    echo ' #' . $project->getId();
}
