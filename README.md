# PHP YouTrack REST

![cog-php-youtrack-rest](https://user-images.githubusercontent.com/1849174/34457236-ab5aa292-edbb-11e7-8555-e454255acd82.png)

<p align="center">
<a href="https://travis-ci.org/cybercog/youtrack-rest-php"><img src="https://img.shields.io/travis/cybercog/youtrack-rest-php/master.svg?style=flat-square" alt="Build Status"></a>
<a href="https://styleci.io/repos/91037527"><img src="https://styleci.io/repos/91037527/shield" alt="StyleCI"></a>
<a href="https://codeclimate.com/github/cybercog/youtrack-rest-php"><img src="https://img.shields.io/codeclimate/github/cybercog/youtrack-rest-php.svg?style=flat-square" alt="Code Climate"></a>
<a href="https://github.com/cybercog/youtrack-rest-php/releases"><img src="https://img.shields.io/github/release/cybercog/youtrack-rest-php.svg?style=flat-square" alt="Releases"></a>
<a href="https://github.com/cybercog/youtrack-rest-php/blob/master/LICENSE"><img src="https://img.shields.io/github/license/cybercog/youtrack-rest-php.svg?style=flat-square" alt="License"></a>
</p>

## Introduction

YouTrack REST API PHP Client uses [PSR-7 (HTTP Message Interface)](http://www.php-fig.org/psr/psr-7/) to connect with [JetBrains YouTrack REST API](https://www.jetbrains.com/help/youtrack/standalone/2017.2/Resources-for-Developers.html).

Part of the [PHP YouTrack SDK](https://github.com/cybercog/youtrack-php-sdk#readme). 

## Contents

- [Features](#features)
- [Requirements](#requirements)
- [Related packages](#related-packages)
- [Frameworks support](#frameworks-support)
- [Installation](#installation)
- [Usage](#usage)
- [Change log](#change-log)
- [Contributing](#contributing)
- [Testing](#testing)
- [Security](#security)
- [Contributors](#contributors)
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

- [PHP YouTrack SDK](https://github.com/cybercog/youtrack-php-sdk#readme) maintained by [Anton Komarev](https://github.com/antonkomarev)

**Share your packages! [We are open](CONTRIBUTING.md) for Pull Requests!**

## Frameworks support

PHP YouTrack REST is framework agnostic package and could be easily used in any PHP framework you want.

### Framework integrations list

- [Laravel YouTrack SDK](https://github.com/cybercog/laravel-youtrack-sdk#readme) maintained by [Anton Komarev](https://github.com/antonkomarev)

**Haven't found your favorite framework in the list? [We are open](CONTRIBUTING.md) for Pull Requests!**

## Installation

The preferred method is via [composer](https://getcomposer.org). Follow the
[installation instructions](https://getcomposer.org/doc/00-intro.md) if you do not already have
composer installed.

Once composer is installed, execute the following command in your project root to install this library:

```shell script
$ composer require cybercog/youtrack-rest-php
```

### Without framework

Be sure to include the autoloader in your project:

```php
require_once '/path/to/your-project/vendor/autoload.php';
```

## Usage

[Usage Documentation](https://github.com/cybercog/youtrack-php-sdk/wiki/PHP-YouTrack-REST)

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Testing

Run the tests with:

```shell script
$ composer test
```

## Security

If you discover any security related issues, please email open@cybercog.su instead of using the issue tracker.

## Contributors

| <a href="https://github.com/antonkomarev">![@antonkomarev](https://avatars.githubusercontent.com/u/1849174?s=110)<br />Anton Komarev</a> | <a href="https://github.com/adam187">![@adam187](https://avatars.githubusercontent.com/u/156628?s=110)<br />Adam Misiorny</a> | <a href="https://github.com/dmkdev"><br />dmkdev</a> | <a href="https://github.com/asteisiunas"><br />asteisiunas</a> | 
| :---: | :---: | :---: | :---: |

[PHP YouTrack REST contributors list](../../contributors)

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

- `PHP YouTrack REST` package is open-sourced software licensed under the [MIT License](LICENSE) by [Anton Komarev].

## About CyberCog

[CyberCog](https://cybercog.su) is a Social Unity of enthusiasts. Research best solutions in product & software development is our passion.

- [Follow us on Twitter](https://twitter.com/cybercog)
- [Read our articles on Medium](https://medium.com/cybercog)

<a href="https://cybercog.su"><img src="https://cloud.githubusercontent.com/assets/1849174/18418932/e9edb390-7860-11e6-8a43-aa3fad524664.png" alt="CyberCog"></a>

[Anton Komarev]: https://komarev.com
