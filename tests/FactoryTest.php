<?php

namespace Chromatic\OrangeDam;

use Chromatic\OrangeDam\Http\Client;
use PHPUnit\Framework\TestCase;

final class FactoryTest extends TestCase
{
    /**
     * Test creation of Factory.
     */
    public function testFactoryCreation(): void
    {
        $factory = new Factory([
            'base_path' => 'https://test.com',
        ]);
        $this->assertInstanceOf(Factory::class, $factory);
    }
}
