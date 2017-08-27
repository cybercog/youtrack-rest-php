# Changelog

All notable changes to `youtrack-rest-php` will be documented in this file.

## [4.0.0] - 2017-08-27

### Changed

- Contracts extracted to `Cog\Contracts\YouTrack` package #32.

## [3.2.0] - 2017-07-29

### Added

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

[4.0.0]: https://github.com/cybercog/youtrack-rest-php/compare/3.2.0...4.0.0
[3.2.0]: https://github.com/cybercog/youtrack-rest-php/compare/3.1.1...3.2.0
[3.1.0]: https://github.com/cybercog/youtrack-rest-php/compare/3.0.0...3.1.0
[3.0.0]: https://github.com/cybercog/youtrack-rest-php/compare/2.0.1...3.0.0
[2.0.1]: https://github.com/cybercog/youtrack-rest-php/compare/1.0.0...2.0.1