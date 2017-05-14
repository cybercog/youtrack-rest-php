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

return [

    /*
    |--------------------------------------------------------------------------
    | YouTrack Base URI
    |--------------------------------------------------------------------------
    |
    | Indicates base URI of the YouTrack instance.
    |
    */

    'base_uri' => env('YOUTRACK_BASE_URI'),

    /*
    |--------------------------------------------------------------------------
    | Default YouTrack Authenticator Name
    |--------------------------------------------------------------------------
    |
    | This option controls the default authenticator that will be used by the
    | library when YouTrack authorization is required. You may set this to
    | any of the drivers defined in the "authenticators" array below.
    |
    | Supported: "token" (recommended), "cookie"
    |
    */

    'authenticator' => env('YOUTRACK_AUTH', 'token'),

    /*
    |--------------------------------------------------------------------------
    | YouTrack Authenticators
    |--------------------------------------------------------------------------
    |
    | Here are each of the authenticators available in YouTrack REST API.
    |
    */

    'authenticators' => [
        'token' => [
            'driver' => \Cog\YouTrack\Authenticators\TokenAuthenticator::class,
            'token' => env('YOUTRACK_TOKEN'),
        ],

        'cookie' => [
            'driver' => \Cog\YouTrack\Authenticators\CookieAuthenticator::class,
            'username' => env('YOUTRACK_USERNAME'),
            'password' => env('YOUTRACK_PASSWORD'),
        ],
    ],
];
