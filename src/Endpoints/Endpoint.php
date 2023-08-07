<?php

namespace Chromatic\OrangeDam\Endpoints;

use Chromatic\OrangeDam\Http\Client;

abstract class Endpoint
{
    /**
     * Client instance.
     *
     * @var \Chromatic\OrangeDam\Http\Client
     */
    protected $client;

    /**
     * Constructor.
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
