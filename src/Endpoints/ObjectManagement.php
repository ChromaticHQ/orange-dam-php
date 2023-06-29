<?php

namespace Chromatic\OrangeDam\Endpoints;

class ObjectManagement extends Endpoint
{
    /**
     * API base path.
     *
     * @var string
     */
    protected const API_BASE_PATH = '/webapi/objectmanagement/';

    /**
     * The Orange DAM API date format.
     *
     * Date format: Use one of these 2 ISO 8601 date formats:
     * YYYY-MM-DD or YYYY-MM-DDTHH:MM:SS
     */
    public const DATE_FORMAT = 'Y-m-d\TH:i:s';

    /**
     * List all deleted objects.
     *
     * @param array $params
     *   Optional parameters.
     *
     * @return \Chromatic\OrangeDam\Http\Response
     */
    public function listDeletedObjects(array $params = [])
    {
        return $this->client->request(
            'get',
            static::API_BASE_PATH . 'deletion/getdeletedobjects_45C_v1',
            $params,
        );
    }
}
