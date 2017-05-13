# YouTrack REST PHP

<p align="center">
<a href="https://travis-ci.org/cybercog/youtrack-rest-php"><img src="https://img.shields.io/travis/cybercog/youtrack-rest-php/master.svg?style=flat-square" alt="Build Status"></a>
<a href="https://styleci.io/repos/91037527"><img src="https://styleci.io/repos/91037527/shield" alt="StyleCI"></a>
<a href="https://github.com/cybercog/youtrack-rest-php/releases"><img src="https://img.shields.io/github/release/cybercog/youtrack-rest-php.svg?style=flat-square" alt="Releases"></a>
<a href="https://github.com/cybercog/youtrack-rest-php/blob/master/LICENSE"><img src="https://img.shields.io/github/license/cybercog/youtrack-rest-php.svg?style=flat-square" alt="License"></a>
</p>

## Introduction

This library utilizes Guzzle HTTP client to perform requests to YouTrack REST API.

## Contents

- [Features](#features)
- [Installation](#installation)
    - [Laravel integration](#laravel-integration)
- [Usage](#usage)
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
- YouTrack Entities with relationships.
- Multiple authentication strategy.
- Covered with unit tests.

## Installation

First, pull in the package through Composer:

```sh
$ composer require cybercog/youtrack-rest-php
```

### Laravel integration

Include the service provider within `app/config/app.php`:

```php
'providers' => [
    Cog\YouTrack\Providers\YouTrackServiceProvider::class,
],
```

## Usage

### Initialize API client

#### Token authentication

```
$http = new \GuzzleHttp\Client([
    'base_uri' => 'https://example.com',
]);

$client = new YouTrackClient($http, [
    'class' => \Cog\YouTrack\Authenticators\TokenAuthenticator::class,
    'token' => 'YOUTRACK_USERNAME',
]);
```

#### Cookie authentication

```
$http = new \GuzzleHttp\Client([
    'base_uri' => 'https://example.com',
]);

$client = new YouTrackClient($http, [
    'class' => \Cog\YouTrack\Authenticators\CookieAuthenticator::class,
    'username' => 'YOUTRACK_USERNAME',
    'password' => 'YOUTRACK_PASSWORD',
]);
```

### Repositories methods

#### Get all accessible projects.

```php
$repository = app(\Cog\YouTrack\Repositories\ProjectRepository::class);
$projects = $repository->all();
```

#### Get project by its project identifier

```php
$projectId = 'TEST';
$repository = app(\Cog\YouTrack\Repositories\ProjectRepository::class);
$projects = $repository->find($projectId);
```

#### Get issue by id

```php
$issueId = 'TEST-1';
$repository = app(\Cog\YouTrack\Repositories\IssueRepository::class);
$issue = $repository->find($issueId);
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

### Java

- [byte-imagination/ytapi](https://github.com/byte-imagination/ytapi)

*Feel free to add more alternatives as Pull Request.*

## License

- `YouTrack REST PHP` package is open-sourced software licensed under the [MIT License](LICENSE).

## About CyberCog

[CyberCog](http://www.cybercog.ru) is a Social Unity of enthusiasts. Research best solutions in product & software development is our passion.

![cybercog-logo](https://cloud.githubusercontent.com/assets/1849174/18418932/e9edb390-7860-11e6-8a43-aa3fad524664.png)
