<?php

namespace Chromatic\OrangeDam\Exceptions;

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
        $req = new Request('GET', '/');
        $res = new Response(200);
        $e = new RequestException('token=12345 Test response message.', $req, $res);
        $orangeException = OrangeDamException::create($e);
        $this->assertSame($orangeException->getMessage(), 'token=*** Test response message.');
    }
}
