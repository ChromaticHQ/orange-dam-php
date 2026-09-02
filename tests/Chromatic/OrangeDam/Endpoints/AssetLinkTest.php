<?php

namespace Chromatic\OrangeDam\Endpoints;

use Chromatic\OrangeDam\Http\Client;
use PHPUnit\Framework\TestCase;

final class AssetLinkTest extends TestCase
{
    /**
     * Test creation of endpoint.
     */
    public function testAssetLinkCreation(): void
    {
        $client = new Client([
            'base_path' => 'https://test.com',
        ]);

        $endpoint = new AssetLink($client);
        $this->assertInstanceOf(Endpoint::class, $endpoint);
    }
}
