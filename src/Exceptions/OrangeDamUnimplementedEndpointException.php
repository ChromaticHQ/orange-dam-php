<?php

namespace Chromatic\OrangeDam\Exceptions;

use Chromatic\OrangeDam\Factory;

class OrangeDamUnimplementedEndpointException extends \Exception
{
    public function __construct(string $endpoint_name, ?\Throwable $previous)
    {
        $message = sprintf(
            'Endpoint %s does not exist. Compare your endpoint name to
            the endpoint classes in the Endpoints/ directory. If the
            Orange Dam Endpoint you wish to use has not been implemented
            consider contributing an endpoint to
            %s',
            escapeshellarg($endpoint_name),
            Factory::PROJECT_URL,
        );
        parent::__construct($message, 0, $previous);
    }
}
