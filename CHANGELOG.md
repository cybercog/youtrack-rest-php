# Changelog

All notable changes to `youtrack-rest-php` will be documented in this file.

## [3.0.0] - 2017-05-22

### Added

- `Authenticator` contract and `CookieAuthenticator` implementation.
- `isStatusCode` assert in `Response` contract.

### Updated

- `CookieAuthorizer` constructor accepts `Authenticator` instead of credentials.
- `TokenAuthorizer` constructor accepts string token instead of array.
- `Authorizer` delegates authentication to `Authenticator`.
- Changed namespace of `AuthenticationException`.
- `getHeaders` method was dropped from `Authorizer` contract.
- `Response` interface methods `getResponse`, `getStatusCode`, `getCookie`, `getLocation` were renamed to `httpResponse`, `statusCode`, `cookie`, `location` respectively.

## [2.0.1] - 2017-05-21

- Dropped Client `getAuthorizer` & `setAuthorizer` rudiment methods.

## 1.0.0 - 2017-05-12

- Initial release.

[3.0.0]: https://github.com/cybercog/youtrack-rest-php/compare/2.0.1...3.0.0
[2.0.1]: https://github.com/cybercog/youtrack-rest-php/compare/1.0.0...2.0.1