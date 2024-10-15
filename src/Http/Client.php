<?php

namespace Chromatic\OrangeDam\Http;

use Chromatic\OrangeDam\Exceptions\BadRequestException;
use Chromatic\OrangeDam\Exceptions\InvalidArgumentException;
use Chromatic\OrangeDam\Exceptions\OrangeDamException;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Psr\Http\Message\ResponseInterface;

class Client
{
    /**
     * Default request timeout.
     *
     * @var integer
     */
    final public const REQUEST_TIMEOUT = 30;

    /**
     * Access token.
     *
     * @var string
     */
    public $token;

    /**
     * Default query string.
     *
     * @var string
     */
    public $defaultQueryString;

    /**
     * Shows if request is authenticated with OAuth2.0.
     *
     * @var bool
     */
    public $oauth2;

    /**
     * The http request client.
     */
    public GuzzleClient $httpClient;

    /**
     * Guzzle allows options into its request method. Prepare for some defaults.
     *
     * @var array
     */
    protected $clientOptions = [];

    /**
     * Request user agent.
     *
     * @var string
     */
    protected $user_agent = 'Chromatic_OrangeDam_PHP (https://github.com/ChromaticHQ/orange-dam-php)';

    /**
     * Constructor.
     *
     * @throws \Chromatic\OrangeDam\Exceptions\OrangeDamException
     */
    public function __construct(array $config = [], GuzzleClient $httpClient = null, array $clientOptions = [])
    {
        // Set default property values.
        $this->token = null;
        $this->oauth2 = false;
        $this->clientOptions = $clientOptions;
        $this->defaultQueryString = !empty($config['query_string']) ? $config['query_string'] : '';

        // Throw an error if the base path isn't set.
        if (empty($config['base_path'])) {
            throw new OrangeDamException('You must provide Orange DAM API Base path.');
        }

        // Creates a new instance
        if (is_null($httpClient)) {
            $httpClient = new GuzzleClient([
                'cookies' => true,
                'timeout' => self::REQUEST_TIMEOUT,
                'base_uri' => $config['base_path'],
            ]);
        }
        $this->httpClient = $httpClient;
    }

    /**
     * Send the request.
     *
     * @return ResponseInterface|\Chromatic\OrangeDam\Http\Response
     *
     * @throws \Chromatic\OrangeDam\Exceptions\OrangeDamException
     *
     * @throws \Chromatic\OrangeDam\Exceptions\BadRequestException
     */
    public function request(
        string $method,
        string $endpoint,
        array $options = [],
        string $query_string = '',
        bool $requires_auth = true
    ) {
        if ($requires_auth && empty($this->token)) {
            throw new InvalidArgumentException('You must provide a Orange DAM API token.');
        }

        // Prepare the full endpoint url.
        $full_query_string = $this->defaultQueryString;
        if (!empty($query_string)) {
            $full_query_string = !empty($full_query_string) ? $full_query_string . '&' . $query_string : $query_string;
        }
        $url = $endpoint . '?' . $full_query_string;

        // Wraps to passed client options.
        $options = [...$this->clientOptions, ...$options];
        $options['headers']['User-Agent'] = $this->user_agent;

        // Adds OAuth2.0 authentication token to the request.
        if ($this->oauth2) {
            $options['headers']['Authorization'] = 'Bearer ' . $this->token;
        }

        try {
            // Make a request with given parameters.
            return new Response($this->httpClient, $method, $url, $options);
        } catch (ServerException $e) {
            throw OrangeDamException::create($e);
        } catch (ClientException $e) {
            throw BadRequestException::create($e);
        }
    }

    /**
     * Set OAuth2 parameters.
     */
    public function setOauth2Token(string $token)
    {
        $this->token = $token;
        $this->oauth2 = true;
    }
}
