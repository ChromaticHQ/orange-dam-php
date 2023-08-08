<?php

namespace Chromatic\OrangeDam\Exceptions;

use Exception;
use Throwable;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\RequestException;

class OrangeDamException extends Exception
{
    /**
     * Response instance.
     *
     * @var null|Response
     */
    protected $response;

    /**
     * Returns response instance.
     *
     * @return null|Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * {@inheritdoc}
     */
    final public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Creates method.
     */
    public static function create(RequestException $guzzleException): self
    {
        $e = new static(
            static::sanitizeResponseMessage($guzzleException->getMessage()),
            $guzzleException->getCode(),
            $guzzleException
        );

        $e->response = $guzzleException->getResponse();

        return $e;
    }

    /**
     * Removes sensitive data from response message.
     *
     * @return string
     *   Sanitized response message.
     */
    protected static function sanitizeResponseMessage(string $message): string
    {
        return preg_replace('/(token)=[a-z0-9-]+/i', '$1=***', $message);
    }
}
