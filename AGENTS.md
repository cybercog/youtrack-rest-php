# AGENTS.md

This file provides guidance to LLM Agents when working with code in this repository.

## Project

PHP YouTrack REST API client (`cybercog/youtrack-rest-php`) — a framework-agnostic library for JetBrains YouTrack REST API using PSR-7. Requires PHP 8.1+.

## Commands

All commands must be run through Docker. Available services: php81, php82, php83, php84, php85.

```bash
# Run all tests
docker compose run --rm php85 composer test

# Run PHPStan static analysis (level 8)
docker compose run --rm php85 composer phpstan

# Run a single test file
docker compose run --rm php85 vendor/bin/phpunit tests/Feature/Client/YouTrackClientTest.php

# Run a single test method
docker compose run --rm php85 vendor/bin/phpunit --filter testMethodName

# Install dependencies
docker compose run --rm php85 composer install
```

## Architecture

The library follows an interface-driven design. Contracts (interfaces) live in `contracts/`, implementations in `src/`.

**Namespace mapping:**
- `Cog\Contracts\YouTrack\Rest\` → `contracts/`
- `Cog\YouTrack\Rest\` → `src/`
- `Cog\YouTrack\Rest\Tests\` → `tests/`

**Key components:**
- `YouTrackClient` — main REST client, delegates HTTP to `HttpClient` and auth to `Authorizer`
- `GuzzleHttpClient` — adapter wrapping Guzzle, translates exceptions to `HttpClientException`
- `TokenAuthorizer` / `CookieAuthorizer` — authorization strategies (Bearer token vs cookie-based)
- `CookieAuthenticator` — handles username/password login flow with cookie caching
- `YouTrackResponse` — wraps PSR-7 response with helpers (`toArray()`, `isSuccess()`, etc.)

**Error handling:** HTTP errors are caught and re-thrown as domain exceptions — 401 → `InvalidAuthorizationToken`, 403 → `AuthenticationException`, others → `ClientException`.

## Code Conventions

- `declare(strict_types=1)` in every file
- All files have MIT license header
- Constructor property promotion with `readonly`
- PSR-12 code style (StyleCI enforced, single-line brace exception for empty classes)
- PHPStan level 8 — all code must be fully type-hinted
- PSR-4 autoloading

## Testing

Tests are in `tests/Feature/` using PHPUnit 10.5+. They use Guzzle `MockHandler` for HTTP isolation (see `HasFakeHttpResponses` trait). Mock responses live in `tests/stubs/server-responses/`. Environment variables for integration tests: `YOUTRACK_BASE_URI`, `YOUTRACK_TOKEN`, `YOUTRACK_AUTH`, `YOUTRACK_PROJECT`.
