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

This library utilizes Guzzle HTTP client to perform requests to JetBrains [YouTrack REST API](https://www.jetbrains.com/help/youtrack/standalone/2017.2/Resources-for-Developers.html).

## Contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
    - [Initialize API client](#initialize-api-client)
    - [API requests](#api-requests)
    - [Get PSR HTTP response](#get-psr-http-response)
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
- Multiple authentication strategies: Token, Cookie.
- Utilizes PHP Standard Recommendations:
  - [PSR-2 (Coding Style Guide)](http://www.php-fig.org/psr/psr-2/).
  - [PSR-4 (Autoloading Standard)](http://www.php-fig.org/psr/psr-4/).
  - [PSR-7 (HTTP Message Interface)](http://www.php-fig.org/psr/psr-7/).
- Covered with unit tests.

## Requirements

- YouTrack >= 2017.1 with REST-API enabled (always enabled, by default)
- PHP >= 7.1
- Guzzle HTTP Client >= 6.2

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

#### Token Authenticator

Starting with YouTrack 2017.1 release [authorization based on permanent tokens](https://www.jetbrains.com/help/youtrack/standalone/2017.2/Manage-Permanent-Token.html) is recommended as the main approach for the authorization in your REST API calls. 

```php
$http = new \GuzzleHttp\Client([
    'base_uri' => 'https://example.com',
]);

$authenticator = new \Cog\YouTrack\Rest\Authenticators\TokenAuthenticator([
    'token' => 'YOUTRACK_API_TOKEN',
]);

$client = new \Cog\YouTrack\Rest\YouTrackClient($http, $authenticator);
```

#### Cookie Authenticator

```php
$http = new \GuzzleHttp\Client([
    'base_uri' => 'https://example.com',
]);

$authenticator = new \Cog\YouTrack\Rest\Authenticators\CookieAuthenticator([
    'username' => 'YOUTRACK_USERNAME',
    'password' => 'YOUTRACK_PASSWORD',
]);

$client = new \Cog\YouTrack\Rest\YouTrackClient($http, $authenticator);
```

### API requests


#### HTTP GET request

```php
$response = $client->get('/issue/TEST-1');
```

#### HTTP POST request

```php
$response = $client->post('/issue', [
    'project' => 'TEST',
    'summary' => 'New test issue',
    'description' => 'Test description',
]);
```

#### HTTP PUT request

```php
$response = $client->put('/issue/TEST-1', [
    'summary' => 'Updated summary',
    'description' => Updated description,
]);
```

#### HTTP DELETE request

```php
$response = $client->delete('/issue/TEST-1');
```

### Get PSR HTTP response

Each successful request to the API returns instance of `\Cog\YouTrack\Rest\Response\Contracts\Response` contract.
PSR HTTP response could be accessed by calling `getResponse` method on API response.

```php
$apiResponse = $client->get('/issue/TEST-1');
$psrResponse = $apiResponse->getResponse();
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

- [Anton Komarev](https://github.com/a-komarev)
- [All Contributors](../../contributors)

## Alternatives

### PHP

- [samson/youtrack](https://github.com/SamsonIT/YouTrack)
- [jsto/youtrack_api_client_php](https://github.com/jsto/youtrack_api_client_php)
- [nepda/youtrack-client](https://github.com/nepda/youtrack-client)

### Python

- [JetBrains/youtrack-rest-python-library](https://github.com/JetBrains/youtrack-rest-python-library)

### Java

- [byte-imagination/ytapi](https://github.com/byte-imagination/ytapi)

*Feel free to add more alternatives as Pull Request.*

## License

- `YouTrack REST PHP` package is open-sourced software licensed under the [MIT License](LICENSE).

## About CyberCog

[CyberCog](http://www.cybercog.ru) is a Social Unity of enthusiasts. Research best solutions in product & software development is our passion.

![cybercog-logo](https://cloud.githubusercontent.com/assets/1849174/18418932/e9edb390-7860-11e6-8a43-aa3fad524664.png)
