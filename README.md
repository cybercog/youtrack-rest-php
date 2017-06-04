# YouTrack REST PHP

![cog-youtrack-rest-php](https://cloud.githubusercontent.com/assets/1849174/26024854/65d76766-37e3-11e7-82ba-e386c9625894.png)

<p align="center">
<a href="https://travis-ci.org/cybercog/youtrack-rest-php"><img src="https://img.shields.io/travis/cybercog/youtrack-rest-php/master.svg?style=flat-square" alt="Build Status"></a>
<a href="https://styleci.io/repos/91037527"><img src="https://styleci.io/repos/91037527/shield" alt="StyleCI"></a>
<a href="https://codeclimate.com/github/cybercog/youtrack-rest-php"><img src="https://img.shields.io/codeclimate/github/cybercog/youtrack-rest-php.svg?style=flat-square" alt="Code Climate"></a>
<a href="https://github.com/cybercog/youtrack-rest-php/releases"><img src="https://img.shields.io/github/release/cybercog/youtrack-rest-php.svg?style=flat-square" alt="Releases"></a>
<a href="https://github.com/cybercog/youtrack-rest-php/blob/master/LICENSE"><img src="https://img.shields.io/github/license/cybercog/youtrack-rest-php.svg?style=flat-square" alt="License"></a>
</p>

## Introduction

YouTrack REST API PHP Client uses [PSR-7 (HTTP Message Interface)](http://www.php-fig.org/psr/psr-7/) to connect with [JetBrains YouTrack REST API](https://www.jetbrains.com/help/youtrack/standalone/2017.2/Resources-for-Developers.html).

Part of the [YouTrack PHP SDK](https://github.com/cybercog/youtrack-php-sdk#readme). 

## Contents

- [Features](#features)
- [Requirements](#requirements)
- [Related packages](#related-packages)
- [Frameworks support](#frameworks-support)
- [Installation](#installation)
- [Usage](#usage)
    - [Initialize API client](#initialize-api-client)
    - [API requests](#api-requests)
    - [API responses](#api-responses)
- [Change log](#change-log)
- [Contributing](#contributing)
- [Testing](#testing)
- [Security](#security)
- [Credits](#credits)
- [Alternatives](#alternatives)
- [License](#license)
- [About CyberCog](#about-cybercog)

## Features

- Framework agnostic.
- Using contracts to keep high customization capabilities.
- Multiple authorization strategies: Token, Cookie.
- Following PHP Standard Recommendations:
  - [PSR-1 (Basic Coding Standard)](http://www.php-fig.org/psr/psr-1/).
  - [PSR-2 (Coding Style Guide)](http://www.php-fig.org/psr/psr-2/).
  - [PSR-4 (Autoloading Standard)](http://www.php-fig.org/psr/psr-4/).
  - [PSR-7 (HTTP Message Interface)](http://www.php-fig.org/psr/psr-7/).
- Covered with unit tests.

## Requirements

- YouTrack >= 3.0 with REST-API enabled (always enabled, by default)
- PHP >= 7.1
- Guzzle HTTP Client >= 6.2

## Related packages

- [YouTrack PHP SDK](https://github.com/cybercog/youtrack-php-sdk#readme) maintained by [Anton Komarev](https://github.com/a-komarev)

**Share your packages! [We are open](CONTRIBUTING.md) for Pull Requests!**

## Frameworks support

YouTrack REST PHP is framework agnostic package and could be easily used in any PHP framework you want.

### Framework integrations list

- [Laravel YouTrack SDK](https://github.com/cybercog/laravel-youtrack-sdk#readme) maintained by [Anton Komarev](https://github.com/a-komarev)

**Haven't found your favorite framework in the list? [We are open](CONTRIBUTING.md) for Pull Requests!**

## Installation

The preferred method is via [composer](https://getcomposer.org). Follow the
[installation instructions](https://getcomposer.org/doc/00-intro.md) if you do not already have
composer installed.

Once composer is installed, execute the following command in your project root to install this library:

```sh
$ composer require cybercog/youtrack-rest-php
```

### Without framework

Be sure to include the autoloader in your project:

```php
require_once '/path/to/your-project/vendor/autoload.php';
```

## Usage

### Initialize API client

#### Token authorization

Starting with YouTrack 2017.1 release [authorization based on permanent tokens](https://www.jetbrains.com/help/youtrack/standalone/2017.2/Manage-Permanent-Token.html) is recommended as the main approach for the authorization in your REST API calls. 

```php
// Instantiate PSR-7 HTTP Client
$psrHttpClient = new \GuzzleHttp\Client([
    'base_uri' => 'https://example.com',
]);

// Instantiate YouTrack API HTTP Client Adapter
$httpClient = new \Cog\YouTrack\Rest\HttpClient\GuzzleHttpClient($psrHttpClient);

// Instantiate YouTrack API Token Authorizer
$authorizer = new \Cog\YouTrack\Rest\Authorizer\TokenAuthorizer('YOUTRACK_API_TOKEN');

// Instantiate YouTrack API Client
$youtrack = new \Cog\YouTrack\Rest\YouTrackClient($httpClient, $authorizer);
```

#### Cookie authorization

```php
// Instantiate PSR-7 HTTP Client
$psrHttpClient = new \GuzzleHttp\Client([
    'base_uri' => 'https://example.com',
]);

// Instantiate YouTrack API HTTP Client Adapter
$httpClient = new \Cog\YouTrack\Rest\HttpClient\GuzzleHttpClient($psrHttpClient);

// Instantiate YouTrack API Cookie Authenticator
$authenticator = new \Cog\YouTrack\Rest\Authenticator\CookieAuthenticator('YOUTRACK_USERNAME', 'YOUTRACK_PASSWORD');

// Instantiate YouTrack API Cookie Authorizer
$authorizer = new \Cog\YouTrack\Rest\Authorizer\CookieAuthorizer($authenticator);

// Instantiate YouTrack API Client
$youtrack = new \Cog\YouTrack\Rest\YouTrackClient($httpClient, $authorizer);
```

### API requests

#### HTTP request

```php
$method = 'POST'; // GET, POST, PUT, DELETE, PATCH or any custom ones
$response = $youtrack->request($method, '/issue', [
    'project' => 'TEST',
    'summary' => 'New test issue',
    'description' => 'Test description',
]);
```

You can [customize requests created and transferred by a client using request options](http://docs.guzzlephp.org/en/latest/request-options.html). Request options control various aspects of a request including, headers, query string parameters, timeout settings, the body of a request, and much more.

```php
$options = [
    'debug' => true,
    'sink' => '/path/to/dump/file',
];
$response = $youtrack->request('POST', '/issue', [
    'project' => 'TEST',
    'summary' => 'New test issue',
    'description' => 'Test description',
], $options);
```

#### HTTP GET request

```php
$response = $youtrack->get('/issue/TEST-1');
```

#### HTTP POST request

```php
$response = $youtrack->post('/issue', [
    'project' => 'TEST',
    'summary' => 'New test issue',
    'description' => 'Test description',
]);
```

#### HTTP PUT request

```php
$response = $youtrack->put('/issue/TEST-1', [
    'summary' => 'Updated summary',
    'description' => 'Updated description',
]);
```

#### HTTP DELETE request

```php
$response = $youtrack->delete('/issue/TEST-1');
```

### API responses

Each successful request to the API returns instance of `\Cog\YouTrack\Rest\Response\Contracts\Response` contract. By default it's `\Cog\YouTrack\Rest\Response\YouTrackResponse` class.

#### Get PSR HTTP response

PSR HTTP response could be accessed by calling `httpResponse` method on API Response.

```php
$youtrackResponse = $youtrack->get('/issue/TEST-1');
$psrResponse = $youtrackResponse->httpResponse();
```

#### Get response headers

Returns headers as string from the HTTP response.

```php
$apiResponse = $youtrack->get('/issue/TEST-1');
$headerString = $apiResponse->header('Any-Header-You-Want');
```

#### Get response Cookie

Returns `Set-Cookie` headers as string from the HTTP response.

```php
$apiResponse = $youtrack->get('/issue/TEST-1');
$cookieString = $apiResponse->cookie();
```

#### Get response Location

Returns `Location` header from the HTTP response.

```php
$apiResponse = $youtrack->get('/issue/TEST-1');
$location = $apiResponse->location();
```

#### Transform response to array

```php
$apiResponse = $youtrack->get('/issue/TEST-1');
$responseArray = $apiResponse->toArray();
```

#### Returns body of the response.

```php
$apiResponse = $youtrack->get('/issue/TEST-1');
$body = $apiResponse->body();
```

#### Get HTTP response status code

```php
$apiResponse = $youtrack->get('/issue/TEST-1');
$location = $apiResponse->statusCode();
```

#### Determine if HTTP response status is 2xx

```php
$apiResponse = $youtrack->get('/issue/TEST-1');
$isSuccess = $apiResponse->isSuccess();
```

#### Determine if HTTP response status is 3xx

```php
$apiResponse = $youtrack->get('/issue/TEST-1');
$isRedirect = $apiResponse->isRedirect();
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Testing

Run the tests with:

```sh
$ composer test
```

## Security

If you discover any security related issues, please email oss@cybercog.su instead of using the issue tracker.

## Credits

|  | @mention |
|---|---|
| ![@a-komarev](https://avatars2.githubusercontent.com/u/1849174?s=64) | [@a-komarev](https://github.com/a-komarev) |

[YouTrack REST PHP contributors list](../../contributors)

## Alternatives

### PHP

- [samson/youtrack](https://github.com/SamsonIT/YouTrack#readme)
- [jsto/youtrack_api_client_php](https://github.com/jsto/youtrack_api_client_php#readme)
- [nepda/youtrack-client](https://github.com/nepda/youtrack-client#readme)

### Python

- [JetBrains/youtrack-rest-python-library](https://github.com/JetBrains/youtrack-rest-python-library#readme)

### .NET

- [JetBrains/YouTrackSharp](https://github.com/JetBrains/YouTrackSharp#readme)

### Java

- [byte-imagination/ytapi](https://github.com/byte-imagination/ytapi#readme)

*Feel free to add more alternatives as Pull Request.*

## License

- `YouTrack REST PHP` package is open-sourced software licensed under the [MIT License](LICENSE).

## About CyberCog

[CyberCog](http://www.cybercog.ru) is a Social Unity of enthusiasts. Research best solutions in product & software development is our passion. You can [follow us on Twitter](https://twitter.com/cybercog), read our [articles on Medium](https://medium.com/cybercog) or [support open source development on Patreon](https://www.patreon.com/cybercog).

<a href="http://cybercog.ru"><img src="https://cloud.githubusercontent.com/assets/1849174/18418932/e9edb390-7860-11e6-8a43-aa3fad524664.png" alt="CyberCog"></a>
