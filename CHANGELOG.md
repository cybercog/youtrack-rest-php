# Changelog

All notable changes to `cybercog/youtrack-rest-php` will be documented in this file.

## [Unreleased]

## [6.2.2] - 2020-07-19

### Fixed

- ([#49]) Fixes from PHPStan static analysis

## [6.2.1] - 2020-07-19

### Fixed

- ([#48]) Fix $endpointPathPrefix class parameter

## [6.2.0] - 2019-10-18

### Added

- ([#43]) Configurable API endpoint prefix

## [6.1.0] - 2018-06-30

### Added

- ([#40]) Multipart requests support for attachments uploads

### Changed

- ([#41]) Add missing `array` type to `$options` argument of `buildOptions` method of `Cog\YouTrack\Rest\Client\YouTrackClient`

## [6.0.2] - 2017-01-10

### Changed

- `Cog\YouTrack\Rest\Client\YouTrackClient` endpoint prefix is relative now ([#39])

## [6.0.0] - 2017-11-20

### Changed

- `Cog\YouTrack\Rest\Authorizer\CookieAuthorizer` stopped to delegate client header manipulation to `Authenticator` ([#32])
- `token` method added to `Cog\Contracts\YouTrack\Rest\Authenticator\Authenticator` contract
- `Cog\Contracts\YouTrack\Rest\Client\Exceptions\ClientException` extends `RuntimeException` instead of `Exception`
- `Cog\Contracts\YouTrack\Rest\Client\Exceptions\HttpClientException` extends `RuntimeException` instead of `Exception`
- `Cog\Contracts\YouTrack\Rest\Authorizer\Exceptions\InvalidTokenException` renamed to `InvalidAuthorizationToken`

### Removed

- Dropped `putHeader` method from `Cog\Contracts\YouTrack\Rest\Client\Client` contract

## [5.0.0] - 2017-09-13

### Changed

- Exceptions moved to `Cog\Contracts\YouTrack` namespace ([#34]).

## [4.0.0] - 2017-08-27

### Changed

- Contracts extracted to `Cog\Contracts\YouTrack` package ([#32]).
  - `Cog\YouTrack\Rest\Authenticator\Contracts` moved to `Cog\Contracts\YouTrack\Rest\Authenticator`
  - `Cog\YouTrack\Rest\Authorizer\Contracts` moved to `Cog\Contracts\YouTrack\Rest\Authorizer`
  - `Cog\YouTrack\Rest\Client\Contracts` moved to `Cog\Contracts\YouTrack\Rest\Client`
  - `Cog\YouTrack\Rest\Client\HttpContracts` moved to `Cog\Contracts\YouTrack\Rest\HttpClient`
  - `Cog\YouTrack\Rest\Client\Response` moved to `Cog\Contracts\YouTrack\Rest\Response`

## [3.2.0] - 2017-07-29

### Changed

- `withHeader`, `withHeaders` methods to `Client` contract.
- `isClientError` & `isServerError` asserts in `Response` contract.

### Updated

- `putHeader` method marked as deprecated to keep naming consistency and aliased to `withHeader`.

## [3.1.0] - 2017-05-25

### Added

- `isSuccess` & `isReponse` asserts to `Response` contract.
- `header` & `body` methods to `Response` contract.

## [3.0.0] - 2017-05-22

### Added

- `Authenticator` contract and `CookieAuthenticator` implementation.
- `HttpClient` contract and `GuzzleHttpClient` implementation.
- `isStatusCode` assert to `Response` contract.

### Updated

- `CookieAuthorizer` constructor accepts `Authenticator` instead of credentials.
- `TokenAuthorizer` constructor accepts string token instead of array.
- `Authorizer` delegates authentication to `Authenticator`.
- `Client` delegates HTTP requests to `HttpClient`.
- Changed namespace of `AuthenticationException`.
- `getHeaders` method was dropped from `Authorizer` contract.
- `Response` interface methods `getResponse`, `getStatusCode`, `getCookie`, `getLocation` were renamed to `httpResponse`, `statusCode`, `cookie`, `location` respectively.
- `User-Agent` header is more verbose.
- REST Client version is defined in `Client` contract instead of each concrete implementation.
- Additional param `$options` was added to `Client` methods: `request`, `get`, `post`, `put`, `delete`.

## [2.0.1] - 2017-05-21

- Dropped Client `getAuthorizer` & `setAuthorizer` rudiment methods.

## 1.0.0 - 2017-05-12

- Initial release.

[Unreleased]: https://github.com/cybercog/youtrack-rest-php/compare/6.2.2...master
[6.2.2]: https://github.com/cybercog/youtrack-rest-php/compare/6.2.1...6.2.2
[6.2.1]: https://github.com/cybercog/youtrack-rest-php/compare/6.2.0...6.2.1
[6.2.0]: https://github.com/cybercog/youtrack-rest-php/compare/6.1.0...6.2.0
[6.1.0]: https://github.com/cybercog/youtrack-rest-php/compare/6.0.2...6.1.0
[6.0.2]: https://github.com/cybercog/youtrack-rest-php/compare/6.0.1...6.0.2
[6.0.0]: https://github.com/cybercog/youtrack-rest-php/compare/5.0.0...6.0.0
[5.0.0]: https://github.com/cybercog/youtrack-rest-php/compare/4.0.0...5.0.0
[4.0.0]: https://github.com/cybercog/youtrack-rest-php/compare/3.2.0...4.0.0
[3.2.0]: https://github.com/cybercog/youtrack-rest-php/compare/3.1.1...3.2.0
[3.1.0]: https://github.com/cybercog/youtrack-rest-php/compare/3.0.0...3.1.0
[3.0.0]: https://github.com/cybercog/youtrack-rest-php/compare/2.0.1...3.0.0
[2.0.1]: https://github.com/cybercog/youtrack-rest-php/compare/1.0.0...2.0.1

[#49]: https://github.com/cybercog/youtrack-rest-php/pull/49
[#48]: https://github.com/cybercog/youtrack-rest-php/pull/48
[#43]: https://github.com/cybercog/youtrack-rest-php/pull/43
[#41]: https://github.com/cybercog/youtrack-rest-php/pull/41
[#40]: https://github.com/cybercog/youtrack-rest-php/pull/40
[#39]: https://github.com/cybercog/youtrack-rest-php/pull/39
[#34]: https://github.com/cybercog/youtrack-rest-php/pull/34
[#32]: https://github.com/cybercog/youtrack-rest-php/pull/32
