<?php

namespace Chromatic\OrangeDam\Http;

use Chromatic\OrangeDam\Endpoints\Search;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Response as GuzzleResponse;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

final class ResponseTest extends TestCase
{
    /**
     * Test creation of Response results in expected default values.
     */
    public function testDefaultConstructor(): void
    {
        $clientMock = $this->getMockBuilder(GuzzleClient::class)
            ->onlyMethods(['request'])
            ->getMock();
        $clientMock->method('request')->willReturn(new GuzzleResponse());
        $response = new Response($clientMock, 'GET', '');
        $this->assertNull($response->getData());
        $this->assertNull($response->toArray());
        $this->assertInstanceOf(StreamInterface::class, $response->getBody());
        $this->assertInstanceOf(ResponseInterface::class, $response->withStatus(200));
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->getReasonPhrase());
        $this->assertSame('1.1', $response->getProtocolVersion());
        $this->assertInstanceOf(MessageInterface::class, $response->withProtocolVersion('1.1'));
        $this->assertSame([], $response->getHeaders());
        $this->assertInstanceOf(MessageInterface::class, $response->withHeader('HeaderName', 'HeaderValue'));
        $this->assertInstanceOf(MessageInterface::class, $response->withAddedHeader('HeaderName', 'HeaderValue'));
        $this->assertInstanceOf(MessageInterface::class, $response->withoutHeader('HeaderName'));
    }

    /**
     * Test Response header methods work as expected.
     */
    public function testHeaders(): void
    {
        $clientMock = $this->getMockBuilder(GuzzleClient::class)
            ->onlyMethods(['request'])
            ->getMock();
        $clientMock->method('request')->willReturn(new GuzzleResponse(200, ['Foo' => 'Bar']));
        $response = new Response($clientMock, 'POST', '/');
        $headers = $response->getHeaders();
        $this->assertTrue($response->hasHeader('Foo'));
        $this->assertSame('Bar', $response->getHeaderLine('Foo'));
        $this->assertSame([0 => 'Bar'], $response->getHeader('Foo'));
    }
}
