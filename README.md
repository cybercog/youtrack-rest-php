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
    - [Laravel integration](#laravel-integration)
- [Usage](#usage)
    - [Initialize API client](#initialize-api-client)
    - [Repositories methods](#repositories-methods)
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
- Multiple authentication strategies: Token, Cookie.
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
require_once('/path/to/your-project/vendor/autoload.php');
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

### Project repository methods

#### Get all accessible projects

```php
$repository = new \Cog\YouTrack\Repositories\RestProjectRepository($client);
$projects = $repository->all();
```

#### Get project by its project identifier

```php
$projectId = 'TEST';
$repository = new \Cog\YouTrack\Repositories\RestProjectRepository($client);
$projects = $repository->find($projectId);
```

#### Create new project

```php
$projectId = 'TEST';
$repository = new \Cog\YouTrack\Repositories\RestProjectRepository($client);
$repository->create($projectId, [
   'projectName' => 'Test project',
   'startingNumber' => 4,
   'projectLeadLogin' => 'admin',
   
   // Optional
   'description' => 'Test description',
]);
```

#### Delete specified project

```php
$projectId = 'TEST';
$repository = new \Cog\YouTrack\Repositories\RestProjectRepository($client);
$repository->delete($projectId);
```

### Issue repository methods

#### Get issue by id

```php
$issueId = 'TEST-1';
$repository = new \Cog\YouTrack\Repositories\RestIssueRepository($client);
$issue = $repository->find($issueId);
```

#### Report a new issue

```php
$repository = new \Cog\YouTrack\Repositories\RestIssueRepository($client);
$repository->create([
    'project' => 'TEST',
    'summary' => 'New summary',
    'description' => 'New description',
]);
```

#### Update summary and description for an issue

```php
$issueId = 'TEST-1';
$repository = new \Cog\YouTrack\Repositories\RestIssueRepository($client);
$repository->update($issueId, [
    'summary' => 'New summary',
    'description' => 'New description',
]);
```

#### Delete specified issue

```php
$issueId = 'TEST-1';
$repository = new \Cog\YouTrack\Repositories\RestIssueRepository($client);
$repository->delete($issueId);
```

#### Check that an issue exists

```php
$issueId = 'TEST-1';
$repository = new \Cog\YouTrack\Repositories\RestIssueRepository($client);
$isIssueExists = $repository->exists($issueId);
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
