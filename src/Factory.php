<?php

namespace Chromatic\OrangeDam;

use Chromatic\OrangeDam\Http\Client;
use Chromatic\OrangeDam\Endpoints\Endpoint;
use Chromatic\OrangeDam\Exceptions\OrangeDamException;

/**
 * Class Factory.
 *
 * @method \Chromatic\OrangeDam\Endpoints\Search       search()
 * @method \Chromatic\OrangeDam\Endpoints\OAuth2       oAuth2()
 */
class Factory {
  /**
   * Client instance.
   *
   * @var Client
   */
  protected $client;

  /**
   * Constructor.
   *
   * @param array $config
   *   An array of configurations. You need at least the 'key'.
   * @param Client $client
   *   Client instance.
   * @param array $clientOptions
   *   Options to be sent with each request.
   *
   * @throws OrangeDamException
   */
  public function __construct(array $config = [], Client $client = null, array $clientOptions = []) {
    if (is_null($client)) {
      $client = new Client($config, null, $clientOptions);
    }
    $this->client = $client;
  }

  /**
   * Return an instance of a Endpoint based on the method called.
   *
   * @param mixed $args
   */
  public function __call(string $name, $args): Endpoint {
    $endpoint = 'Chromatic\\OrangeDam\\Endpoints\\' . ucfirst($name);

    return new $endpoint($this->client, ...$args);
  }

  /**
   * Returns client instance.
   *
   * @return Client
   *   Client instance.
   */
  public function getClient(): Client {
    return $this->client;
  }

}
