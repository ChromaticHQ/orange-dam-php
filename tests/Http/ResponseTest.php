<?php

namespace Chromatic\OrangeDam\Http;

use GuzzleHttp\Psr7\Response as GuzzleResponse;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

final class ResponseTest extends TestCase
{
    /**
     * Test creation of Response results in expected default values.
     */
    public function testDefaultConstructor(): void
    {
        $response = new Response(new GuzzleResponse());
        $this->assertInstanceOf(StreamInterface::class, $response->getBody());
        $this->assertInstanceOf(ResponseInterface::class, $response->withStatus(200));
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame([], $response->getHeaders());
        $this->assertSame('1.1', $response->getProtocolVersion());
        $this->assertSame(null, $response->getData());
        $this->assertSame(null, $response->toArray());
    }

    /**
     * Test Response header methods work as expected.
     */
    public function testHeaders(): void
    {
        $response = new Response(new GuzzleResponse(200, ['Foo' => 'Bar']));
        $headers = $response->getHeaders();
        $this->assertSame(true, $response->hasHeader('Foo'));
        $this->assertSame('Bar', $response->getHeaderLine('Foo'));
        $this->assertSame([0 => 'Bar'], $response->getHeader('Foo'));
    }
}
