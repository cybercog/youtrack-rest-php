<?php

namespace Cog\YouTrack\Rest\Tests\Feature\Client;

use Cog\Contracts\YouTrack\Rest\Client\Client;
use Cog\YouTrack\Rest\Authorizer\TokenAuthorizer;
use Cog\YouTrack\Rest\Client\YouTrackClient;
use Cog\YouTrack\Rest\HttpClient\GuzzleHttpClient;
use Cog\YouTrack\Rest\Tests\Feature\AbstractFeatureTestCase;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

final class YouTrackClientTest extends AbstractFeatureTestCase
{
    public static function request_data_provider(): array
    {
        /** @var array $curlVersion */
        $curlVersion = curl_version();
        $userAgent = 'Cog-YouTrack-REST-PHP/' . Client::VERSION . ' GuzzleHttp/7 curl/' . $curlVersion['version'] . ' PHP/' . PHP_VERSION;
        return [
            'no params' => [
                'request args' => ['GET', '/issues'],
                'expected url' => 'api/issues',
                'expected headers' => [
                    'Authorization' => ['Bearer my-token'],
                    'Accept' => ['application/json'],
                    'User-Agent' => [$userAgent],
                ],
                'expected body' => '',
            ],
            'with params' => [
                'request args' => ['POST', '/issues', ['key' => 'value']],
                'expected url' => 'api/issues',
                'expected headers' => [
                    'Authorization' => ['Bearer my-token'],
                    'Accept' => ['application/json'],
                    'Content-Type' => ['application/x-www-form-urlencoded'],
                    'Content-Length' => ['9'],
                    'User-Agent' => [$userAgent],
                ],
                'expected body' => 'key=value',
            ],
            'with custom headers' => [
                'request args' => ['POST', '/issues', [], ['headers' => [
                    'X-Header' => 'x-value',
                    'Accept' => 'text/plain',
                ]]],
                'expected url' => 'api/issues',
                'expected headers' => [
                    'Authorization' => ['Bearer my-token'],
                    'X-Header' => ['x-value'],
                    'Accept' => ['text/plain'],
                    'User-Agent' => [$userAgent],
                ],
                'expected body' => '',
            ],
            'with form_params option' => [
                'request args' => ['POST', '/issues', [], ['form_params' => [
                    'key' => 'value',
                ]]],
                'expected url' => 'api/issues',
                'expected headers' => [
                    'Authorization' => ['Bearer my-token'],
                    'Accept' => ['application/json'],
                    'Content-Type' => ['application/x-www-form-urlencoded'],
                    'Content-Length' => ['9'],
                    'User-Agent' => [$userAgent],
                ],
                'expected body' => 'key=value',
            ],
            'with params and form_params option' => [
                'request args' => ['POST', '/issues', ['key1' => 'value1'], ['form_params' => [
                    'key2' => 'value2',
                ]]],
                'expected url' => 'api/issues',
                'expected headers' => [
                    'Authorization' => ['Bearer my-token'],
                    'Accept' => ['application/json'],
                    'Content-Type' => ['application/x-www-form-urlencoded'],
                    'Content-Length' => ['23'],
                    'User-Agent' => [$userAgent],
                ],
                'expected body' => 'key1=value1&key2=value2',
            ],
        ];
    }

    #[Test]
    #[DataProvider('request_data_provider')]
    public function it_builds_correct_request(array $requestArgs, string $expectedUri, array $expectedHeaders, string $expectedBody): void
    {
        $requests = [];
        $client = $this->createClient('my-token', $requests);

        $client->request(...$requestArgs);

        /** @var Request $request */
        $request = $requests[0]['request'];
        $this->assertEquals($expectedUri, (string) $request->getUri());
        $this->assertEquals($expectedHeaders, $request->getHeaders());
        $this->assertEquals($expectedBody, (string) $request->getBody());
    }

    #[Test]
    public function it_builds_correct_multipart_request(): void
    {
        $requests = [];
        $client = $this->createClient('my-token', $requests);

        $client->request('POST', '/issues', [], ['multipart' => [[
            'name' => 'my-name',
            'contents' => 'my-value',
        ]]]);

        /** @var Request $request */
        $request = $requests[0]['request'];
        $contentType = $request->getHeaders()['Content-Type'][0];
        $this->assertStringStartsWith('multipart/form-data; boundary=', $contentType);
        $boundary = mb_substr($contentType, mb_strlen('multipart/form-data; boundary='));
        $expectedBody = <<<EOF
            --$boundary\r
            Content-Disposition: form-data; name="my-name"\r
            Content-Length: 8\r
            \r
            my-value\r
            --$boundary--\r

            EOF;
        $this->assertEquals($expectedBody, (string) $request->getBody());
    }

    #[Test]
    public function it_builds_correct_multipart_request_with_params(): void
    {
        $requests = [];
        $client = $this->createClient('my-token', $requests);

        $client->request('POST', '/issues', ['another-name' => 'another-value'], ['multipart' => [[
            'name' => 'my-name',
            'contents' => 'my-value',
        ]]]);

        /** @var Request $request */
        $request = $requests[0]['request'];
        $contentType = $request->getHeaders()['Content-Type'][0];
        $this->assertStringStartsWith('multipart/form-data; boundary=', $contentType);
        $boundary = mb_substr($contentType, mb_strlen('multipart/form-data; boundary='));
        $expectedBody = <<<EOF
            --$boundary\r
            Content-Disposition: form-data; name="my-name"\r
            Content-Length: 8\r
            \r
            my-value\r
            --$boundary\r
            Content-Disposition: form-data; name="another-name"\r
            Content-Length: 13\r
            \r
            another-value\r
            --$boundary--\r\n
            EOF;
        $this->assertEquals($expectedBody, (string) $request->getBody());
    }

    private function createClient(string $token, array &$requestsContainer): YouTrackClient
    {
        $mock = new MockHandler([$this->createFakeResponse()]);
        $handler = HandlerStack::create($mock);
        $handler->push(Middleware::history($requestsContainer));
        $httpClient = new GuzzleHttpClient(new HttpClient(['handler' => $handler]));
        $authorizer = new TokenAuthorizer($token);
        return new YouTrackClient($httpClient, $authorizer);
    }
}
