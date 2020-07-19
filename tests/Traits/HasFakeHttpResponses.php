<?php

declare(strict_types=1);

/*
 * This file is part of PHP YouTrack REST.
 *
 * (c) Anton Komarev <anton@komarev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cog\YouTrack\Rest\Tests\Traits;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

trait HasFakeHttpResponses
{
    /**
     * Instantiate fake HTTP Response.
     *
     * @param int $statusCode
     * @param null|string $name
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function createFakeResponse(int $statusCode = 200, string $name = null): ResponseInterface
    {
        if (is_null($name)) {
            return new Response($statusCode);
        }

        return new Response(
            $statusCode,
            $this->getFakeResponseHeaders($name),
            $this->getFakeResponseBody($name)
        );
    }

    /**
     * Get fake HTTP Response headers.
     *
     * @param string $name
     * @return array
     */
    protected function getFakeResponseHeaders(string $name): array
    {
        $filePath = $this->buildFakeRequestFilePath($name, 'headers');

        if (!file_exists($filePath)) {
            return [];
        }

        $file = file_get_contents($filePath);

        if ($file === false) {
            return [];
        }

        return json_decode($file, true);
    }

    /**
     * Get fake HTTP Response body.
     *
     * @param string $name
     * @return null|string
     */
    protected function getFakeResponseBody(string $name): ?string
    {
        $filePath = $this->buildFakeRequestFilePath($name, 'body');

        if (file_exists($filePath) === false) {
            return null;
        }

        $file = file_get_contents($filePath);

        if ($file === false) {
            return null;
        }

        return $file;
    }

    /**
     * Store HTTP response as fake data for later use.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param string $name
     * @return void
     */
    protected function storeResponseAsFake(ResponseInterface $response, $name): void
    {
        $response = $this->unsetFakeResponseHeaders($response, [
            'Server',
            'Date',
            'Connection',
            'X-XSS-Protection',
            'X-Frame-Options',
            'X-Content-Type-Options',
            'Expires',
            'Cache-Control',
            'Access-Control-Allow-Origin',
            'Access-Control-Allow-Credentials',
            'Access-Control-Expose-Headers',
        ]);

        $headers = $response->getHeaders();
        if (!empty($headers)) {
            $dir = $this->buildFakeRequestDirectoryPath($name);
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }

            $path = $this->buildFakeRequestFilePath($name, 'headers');
            $headers = $this->overwriteFakeRequestSessionCookie($headers, 'VALID-FAKE-SESSION-ID');
            file_put_contents($path, json_encode($headers));
        }

        $body = $response->getBody()->getContents();
        if ($body) {
            $this->createFakeResponseDirectory($name);

            $path = $this->buildFakeRequestFilePath($name, 'body');
            file_put_contents($path, $body);
        }
    }

    /**
     * Overwrite fake HTTP Response session cookie.
     *
     * @param array $headers
     * @param string $value
     * @return array
     */
    protected function overwriteFakeRequestSessionCookie(array $headers, string $value): array
    {
        if (!isset($headers['Set-Cookie'])) {
            return $headers;
        }

        foreach ($headers['Set-Cookie'] as $cookieKey => &$cookie) {
            if (strpos($cookie, 'YTJSESSIONID') !== false) {
                $cookieParts = explode(';', $cookie);
                $cookieParts[0] = 'YTJSESSIONID=' . $value;
                $cookie = implode(';', $cookieParts);
            }
        }

        return $headers;
    }

    /**
     * Create directory for HTTP fake responses if not exists.
     *
     * @param string $name
     */
    private function createFakeResponseDirectory(string $name): void
    {
        $dir = $this->buildFakeRequestDirectoryPath($name);
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
    }

    /**
     * Unset all provided headers from the HTTP Response.
     *
     * @todo Use Middleware http://docs.guzzlephp.org/en/latest/handlers-and-middleware.html#middleware
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param array $headers
     * @return \Psr\Http\Message\ResponseInterface
     */
    private function unsetFakeResponseHeaders(ResponseInterface $response, array $headers = []): ResponseInterface
    {
        foreach ($headers as $header) {
            $response = $response->withoutHeader($header);
        }

        return $response;
    }

    /**
     * Build path to fake HTTP Response data directory.
     *
     * @param string $name
     * @return string
     */
    private function buildFakeRequestDirectoryPath(string $name): string
    {
        return sprintf(
            '%s/../stubs/server-responses/2017.2/%s',
            __DIR__, ltrim($name, '/')
        );
    }

    /**
     * Build path to fake HTTP Response data file.
     *
     * @param string $name
     * @param string $filename
     * @return string
     */
    private function buildFakeRequestFilePath(string $name, string $filename): string
    {
        return sprintf(
            '%s/%s.json',
            $this->buildFakeRequestDirectoryPath($name), $filename
        );
    }
}
