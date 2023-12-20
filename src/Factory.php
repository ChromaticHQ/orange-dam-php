<?php

namespace Chromatic\OrangeDam;

use Chromatic\OrangeDam\Endpoints\{AssetLink, DataTable, Endpoint, MediaFile, OAuth2, ObjectManagement, Search};
use Chromatic\OrangeDam\Exceptions\{OrangeDamException, OrangeDamUnimplementedEndpointException};
use Chromatic\OrangeDam\Http\Client;

/**
 * Class Factory.
 *
 * Manages the connection to Orange DAM API and a library of endpoints.
*/
class Factory
{
    /**
     * Project URL.
     */
    final public const PROJECT_URL = 'https://https://github.com/ChromaticHQ/orange-dam-php';

    /**
     * Client instance.
     */
    protected Client $client;

    /**
     * Constructor.
     *
     * The config array requires a 'key' entry.
     *
     * @throws OrangeDamException
     */
    public function __construct(array $config = [], Client $client = null, array $clientOptions = [])
    {
        if (is_null($client)) {
            $client = new Client($config, null, $clientOptions);
        }
        $this->client = $client;
    }

    /**
     * Returns the Orange DAM API Endpoint requested by name.
     */
    private function getEndpoint(string $endpoint_name, mixed $args = []): Endpoint
    {
        $endpoint_class = 'Chromatic\\OrangeDam\\Endpoints\\' . $endpoint_name;
        try {
            $endpoint = new $endpoint_class($this->client, ...$args);
        } catch (\Throwable $e) {
            throw new OrangeDamUnimplementedEndpointException($endpoint_name, $e);
        }

        return $endpoint;
    }

    /**
     * Returns an Orange Dam API AssetLink endpoint.
     */
    public function assetLink(): AssetLink
    {
        return $this->getEndpoint('AssetLink');
    }

    /**
     * Returns an Orange Dam API DataTable endpoint.
     */
    public function dataTable(): DataTable
    {
        return $this->getEndpoint('DataTable');
    }

    /**
     * Returns an Orange Dam API MediaFile endpoint.
     */
    public function mediaFile(): MediaFile
    {
        return $this->getEndpoint('MediaFile');
    }

    /**
     * Returns an Orange Dam API OAuth2 endpoint.
     */
    public function oAuth2(): OAuth2
    {
        return $this->getEndpoint('OAuth2');
    }

    /**
     * Returns an Orange Dam API ObjectManagement endpoint.
     */
    public function objectManagement(): ObjectManagement
    {
        return $this->getEndpoint('ObjectManagement');
    }

    /**
     * Returns an Orange Dam API Search endpoint.
     */
    public function search(): Search
    {
        return $this->getEndpoint('Search');
    }

    /**
     * Returns an Orange DAM client instance.
     */
    public function getClient(): Client
    {
        return $this->client;
    }
}
