<?php

namespace Chromatic\OrangeDam\Exceptions;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

final class OrangeDamExceptionTest extends TestCase
{
    public function testClassConstructor()
    {
        $exception = new OrangeDamException('Test exception text.');
        $this->assertInstanceOf(OrangeDamException::class, $exception);
    }

    public function testSanitizeResponse()
    {
        $req = new Request('GET', '/');
        $res = new Response(200);
        $e = new RequestException('token=12345 Test response message.', $req, $res);
        $orangeException = OrangeDamException::create($e);
        $this->assertEquals($orangeException->getMessage(), 'token=*** Test response message.');
    }
}
