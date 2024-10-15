<?php

namespace Chromatic\OrangeDam\Http;

use Chromatic\OrangeDam\Exceptions\InvalidArgumentException;
use Chromatic\OrangeDam\Exceptions\OrangeDamException;
use GuzzleHttp\Client as GuzzleClient;
use PHPUnit\Framework\TestCase;

final class ClientTest extends TestCase
{
    /**
     * Test creation of Client succeeds and returns object of expected type.
     */
    public function testClientCreation(): void
    {
        $client = new Client([
            'base_path' => 'https://test.com',
        ]);
        $this->assertInstanceOf(GuzzleClient::class, $client->httpClient);
    }

    /**
     * Test creation of Client with missing base_path results in OrangeDamException.
     */
    public function testBasePathMissingException(): void
    {
        $this->expectException(OrangeDamException::class);
        $client = new Client();
    }

    /**
     * Test request with missing argument results in InvalidArgumentException.
     */
    public function testMissingApiToken(): void
    {
        $client = new Client([
            'base_path' => 'https://test.com',
        ]);
        $this->expectException(InvalidArgumentException::class);
        $client->request('testMethod', 'testEndpoint');
    }

    /**
     * Test setOauth2Token().
     */
    public function testSetOauthToken(): void
    {
        $client = new Client([
            'base_path' => 'https://test.com',
        ]);
        $client->setOauth2Token('example-token');
        $this->assertTrue($client->oauth2);
        $this->assertSame('example-token', $client->token);
    }
}
