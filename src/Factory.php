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
     * Project URL
     */
    const PROJECT_URL = 'https://https://github.com/ChromaticHQ/orange-dam-php';

    /**
     * Client instance.
     *
     * @var Client
     */
    protected $client;

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
   *
   * @param string $endpoint_name
   * @param mixed $args
   *
   * @return \Chromatic\OrangeDam\Endpoints\Endpoint
   */
    public function getEndpoint(string $endpoint_name, mixed $args = []): Endpoint {
      $endpoint_class = 'Chromatic\\OrangeDam\\Endpoints\\' . $endpoint_name. 'X';
      try {
        $endpoint = new $endpoint_class($this->client, ...$args);
      }
      catch (\Exception $e) {
        $message = sprintf('Endpoint %s does not exist. Compare your endpoint name to the endpoint classes in the Endpoints/ directory.
        If the Orange Dam endpoint you wish to use has not been implemented consider contributing an endpoint to %s',
          htmlspecialchars(escapeshellarg($endpoint_name)),
          static::PROJECT_URL,
        );
        throw new OrangeDamUnimplementedEndpointException($message);
      }

      return $endpoint;
    }

    /**
     * Returns an Orange Dam API AssetLink endpoint.
     *
     * Use getEndpoint('AssetLink') instead.
     *
     * @return \Chromatic\OrangeDam\Endpoints\AssetLink
     * @deprecated
     */
    public function assetLink(): AssetLink {
      return $this->getEndpoint('AssetLink');
    }

    /**
     * Returns an Orange Dam API DataTable endpoint.
     *
     * Use getEndpoint('DataTable') instead.
     *
     * @return \Chromatic\OrangeDam\Endpoints\DataTable
     * @deprecated
     */
    public function dataTable(): DataTable {
      return $this->getEndpoint('DataTable');
    }

    /**
     * Returns an Orange Dam API MediaFile endpoint.
     *
     * Use getEndpoint('MediaFile') instead.
     *
     * @return \Chromatic\OrangeDam\Endpoints\MediaFile
     * @deprecated
     */
    public function mediaFile(): MediaFile {
      return $this->getEndpoint('MediaFile');
    }

    /**
     * Returns an Orange Dam API OAuth2 endpoint.
     *
     * Use getEndpoint('OAuth2') instead.
     *
     * @return \Chromatic\OrangeDam\Endpoints\OAuth2
     * @deprecated
     */
    public function oAuth2(): OAuth2 {
      return $this->getEndpoint('OAuth2');
    }

    /**
     * Returns an Orange Dam API ObjectManagement endpoint.
     *
     * Use getEndpoint('ObjectManagement') instead.
     *
     * @return \Chromatic\OrangeDam\Endpoints\ObjectManagement
     * @deprecated
     */
    public function objectManagement(): ObjectManagement {
      return $this->getEndpoint('ObjectManagement');
    }

    /**
     * Returns an Orange Dam API Search endpoint.
     *
     * Use getEndpoint('Search') instead.
     *
     * @return \Chromatic\OrangeDam\Endpoints\Search
     * @deprecated
     */
    public function search(): Search {
      return $this->getEndpoint('Search');
    }

    /**
     * Returns an Orange DAM client instance.
     *
     * @return Client
     *   An Orange DAM Client instance.
     */
    public function getClient(): Client
    {
        return $this->client;
    }
}
