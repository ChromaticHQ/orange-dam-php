<?php

namespace Chromatic\OrangeDam\Http;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ResponseInterface;

class Response implements ResponseInterface
{
    /**
     * Response data.
     *
     * @var mixed
     */
    public $data;

    protected string $request;

    protected array $requestOptions;

    /**
     * Response instance.
     *
     * @var \Psr\Http\Message\ResponseInterface
     */
    protected $response;

    /**
     * Constructor.
     *
     */
    public function __construct(\GuzzleHttp\ClientInterface $client, string $method, string $url, array $options = [])
    {
        $this->response = $client->request($method, $url, $options);
        $this->request = sprintf('%s %s', $method, $url);
        $this->requestOptions = $options;
    }

    /**
     * Get the API data from the response by name.
     *
     * @param string $name
     *   Property name.
     *
     * @return mixed
     *   Property data.
     */
    public function __get($name)
    {
        return $this->getData()->{$name};
    }

    /**
     * Get the underlying data.
     *
     * @return mixed
     *   Response data.
     */
    public function getData()
    {
        if (is_null($this->data)) {
            $this->data = $this->getDataFromResponse($this->response);
        }
        return $this->data;
    }

    /**
     * Return an array of the data.
     *
     * @return array
     *   Response data as array.
     */
    public function toArray()
    {
        return json_decode(json_encode($this->data, JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * Get data from Response.
     *
     * @return mixed
     *   Response data.
     */
    private function getDataFromResponse(ResponseInterface $response)
    {
        $contents = $response->getBody()->getContents();

        return $contents ? json_decode($contents, null, 512, JSON_THROW_ON_ERROR) : null;
    }

    /**
     * {@inheritdoc}
     */
    public function getBody(): StreamInterface
    {
        return $this->response->getBody();
    }

    /**
     * If there is no stream, consider it an empty response.
     */
    public function isEmpty(): bool
    {
        return is_null($this->response->getBody()->getSize());
    }

    /**
     * Returns the request string that created this response.
     */
    public function getRequest(): string {
      return $this->request;
    }

    /**
     * Returns the request options array that created this response.
     */
    public function getRequestOptions(): array {
      return $this->requestOptions;
    }

    /**
     * {@inheritdoc}
     */
    public function getStatusCode(): int
    {
        return $this->response->getStatusCode();
    }

    /**
     * {@inheritdoc}
     */
    public function withStatus($code, $reasonPhrase = ''): ResponseInterface
    {
        return $this->response->withStatus($code, $reasonPhrase);
    }

    /**
     * {@inheritdoc}
     */
    public function getReasonPhrase(): string
    {
        return $this->response->getReasonPhrase();
    }

    /**
     * {@inheritdoc}
     */
    public function getProtocolVersion(): string
    {
        return $this->response->getProtocolVersion();
    }

    /**
     * {@inheritdoc}
     */
    public function withProtocolVersion($version): MessageInterface
    {
        return $this->response->withProtocolVersion($version);
    }

    /**
     * {@inheritdoc}
     */
    public function getHeaders(): array
    {
        return $this->response->getHeaders();
    }

    /**
     * {@inheritdoc}
     */
    public function hasHeader($name): bool
    {
        return $this->response->hasHeader($name);
    }

    /**
     * {@inheritdoc}
     */
    public function getHeader($name): array
    {
        return $this->response->getHeader($name);
    }

    /**
     * {@inheritdoc}
     */
    public function getHeaderLine($name): string
    {
        return $this->response->getHeaderLine($name);
    }

    /**
     * {@inheritdoc}
     */
    public function withHeader($name, $value): MessageInterface
    {
        return $this->response->withHeader($name, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function withAddedHeader($name, $value): MessageInterface
    {
        return $this->response->withAddedHeader($name, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function withoutHeader($name): MessageInterface
    {
        return $this->response->withoutHeader($name);
    }

    /**
     * {@inheritdoc}
     */
    public function withBody(StreamInterface $body): MessageInterface
    {
        return $this->response->withBody($body);
    }
}
