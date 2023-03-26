<?php

namespace Chromatic\OrangeDam\Http;

use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ResponseInterface;

class Response implements ResponseInterface {
  /**
   * Response data.
   *
   * @var mixed
   */
  public $data;

  /**
   * Response instance.
   *
   * @var \Psr\Http\Message\ResponseInterface
   */
  protected $response;

  /**
   * Constructor.
   *
   * @param ResponseInterface $response
   *   Response instance.
   */
  public function __construct(ResponseInterface $response) {
    $this->response = $response;
    $this->data = $this->getDataFromResponse($response);
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
  public function __get($name) {
    return $this->data->{$name};
  }

  /**
   * Get the underlying data.
   *
   * @return mixed
   *   Response data.
   */
  public function getData() {
    return $this->data;
  }

  /**
   * Return an array of the data.
   *
   * @return array
   *   Response data as array.
   */
  public function toArray() {
    return json_decode(json_encode($this->data), true);
  }

  /**
   * Get data from Response.
   *
   * @return mixed
   *   Response data.
   */
  private function getDataFromResponse(ResponseInterface $response) {
    $contents = $response->getBody()->getContents();

    return $contents ? json_decode($contents) : null;
  }

  /**
   * {@inheritdoc}
   */
  public function getBody() {
    return $this->response->getBody();
  }

  /**
   * {@inheritdoc}
   */
  public function getStatusCode() {
    return $this->response->getStatusCode();
  }

  /**
   * {@inheritdoc}
   */
  public function withStatus($code, $reasonPhrase = '') {
    return $this->response->withStatus($code, $reasonPhrase);
  }

  /**
   * {@inheritdoc}
   */
  public function getReasonPhrase() {
    return $this->response->getReasonPhrase();
  }

  /**
   * {@inheritdoc}
   */
  public function getProtocolVersion() {
    return $this->response->getProtocolVersion();
  }

  /**
   * {@inheritdoc}
   */
  public function withProtocolVersion($version) {
    return $this->response->withProtocolVersion($version);
  }

  /**
   * {@inheritdoc}
   */
  public function getHeaders() {
    return $this->response->getHeaders();
  }

  /**
   * {@inheritdoc}
   */
  public function hasHeader($name) {
    return $this->response->hasHeader($name);
  }

  /**
   * {@inheritdoc}
   */
  public function getHeader($name) {
    return $this->response->getHeader($name);
  }

  /**
   * {@inheritdoc}
   */
  public function getHeaderLine($name) {
    return $this->response->getHeaderLine($name);
  }

  /**
   * {@inheritdoc}
   */
  public function withHeader($name, $value) {
    return $this->response->withHeader($name, $value);
  }

  /**
   * {@inheritdoc}
   */
  public function withAddedHeader($name, $value) {
    return $this->response->withAddedHeader($name, $value);
  }

  /**
   * {@inheritdoc}
   */
  public function withoutHeader($name) {
    return $this->response->withoutHeader($name);
  }

  /**
   * {@inheritdoc}
   */
  public function withBody(StreamInterface $body) {
    return $this->response->withBody($body);
  }
}
