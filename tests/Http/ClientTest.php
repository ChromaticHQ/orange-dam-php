<?php

namespace Chromatic\OrangeDam\Http;

use Chromatic\OrangeDam\Exceptions\InvalidArgumentException;
use Chromatic\OrangeDam\Exceptions\OrangeDamException;
use GuzzleHttp\Client as GuzzleClient;
use PHPUnit\Framework\TestCase;

final class ClientTest extends TestCase
{
    public function testClientCreation(): void
    {
        $client = new Client([
            'base_path' => 'https://test.com',
        ]);
        $this->assertInstanceOf(GuzzleClient::class, $client->client);
    }

    public function testBasePathMissingException(): void
    {
        $this->expectException(OrangeDamException::class);
        $client = new Client();
    }

    public function testMissingApiToken(): void
    {
        $client = new Client([
            'base_path' => 'https://test.com',
        ]);
        $this->expectException(InvalidArgumentException::class);
        $client->request('testMethod', 'testEndpoint');
    }
}
