<?php

namespace Chromatic\OrangeDam;

use Chromatic\OrangeDam\Endpoints\{AssetFile,
  AssetLink,
  DataTable,
  Endpoint,
  MediaFile,
  OAuth2,
  ObjectManagement,
  Search};
use Chromatic\OrangeDam\Exceptions\OrangeDamException;
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

    public function assetFile(): AssetFile
    {
        return new AssetFile($this->client);
    }

    /**
     * Returns an Orange Dam API AssetLink endpoint.
     */
    public function assetLink(): AssetLink
    {
        return new AssetLink($this->client);
    }

    /**
     * Returns an Orange Dam API DataTable endpoint.
     */
    public function dataTable(): DataTable
    {
        return new DataTable($this->client);
    }

    /**
     * Returns an Orange Dam API MediaFile endpoint.
     */
    public function mediaFile(): MediaFile
    {
        return new MediaFile($this->client);
    }

    /**
     * Returns an Orange Dam API OAuth2 endpoint.
     */
    public function oAuth2(): OAuth2
    {
        return new OAuth2($this->client);
    }

    /**
     * Returns an Orange Dam API ObjectManagement endpoint.
     */
    public function objectManagement(): ObjectManagement
    {
        return new ObjectManagement($this->client);
    }

    /**
     * Returns an Orange Dam API Search endpoint.
     */
    public function search(): Search
    {
        return new Search($this->client);
    }

    /**
     * Returns an Orange DAM client instance.
     */
    public function getClient(): Client
    {
        return $this->client;
    }
}
