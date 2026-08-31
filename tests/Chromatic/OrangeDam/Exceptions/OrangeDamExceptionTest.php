<?php

namespace Chromatic\OrangeDam\Exceptions;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

final class OrangeDamExceptionTest extends TestCase
{
    /**
     * Test creation of OrangeDamException results in expected object.
     */
    public function testClassConstructor(): void
    {
        $exception = new OrangeDamException('Test exception text.');
        $this->assertInstanceOf(OrangeDamException::class, $exception);
    }

    /**
     * Test OrangeDamException message sanitization works as expected.
     */
    public function testSanitizeResponse(): void
    {
        // Handle Guzzle RequestException constructor change in version 8.
        $client_class = ClientInterface::class;
        if (defined("$client_class::MAJOR_VERSION") && ClientInterface::MAJOR_VERSION > 7) {
            $response = 200;
        } else {
            $response = new Response(200);
        }
        $e = new RequestException(
            'token=12345 Test response message.',
            new Request('GET', '/'),
            $response,
        );
        $orangeException = OrangeDamException::create($e);
        $this->assertSame($orangeException->getMessage(), 'token=*** Test response message.');
    }

    /**
     * Test OrangeDamException getResponse() method.
     */
    public function testGetResponse(): void
    {
        // Handle Guzzle RequestException constructor change in version 8.
        if (ClientInterface::MAJOR_VERSION > 7) {
            $response = 200;
        } else {
            $response = new Response(200);
        }
        $e = new RequestException(
            '',
            new Request('GET', '/'),
            $response,
        );
        $orangeException = OrangeDamException::create($e);
        $this->assertInstanceOf(Response::class, $orangeException->getResponse());
    }
}
