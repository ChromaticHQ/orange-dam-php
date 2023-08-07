<?php

namespace Chromatic\OrangeDam\Endpoints;

class DataTable extends Endpoint
{
    /**
     * API base path.
     *
     * @var string
     */
    protected const API_BASE_PATH = '/API/v2.2/DataTable/';

    /**
     * The Orange DAM API date format.
     *
     * Date format: Use one of these 2 ISO 8601 date formats:
     * YYYY-MM-DD or YYYY-MM-DDTHH:MM:SS
     */
    final public const DATE_FORMAT = 'Y-m-d\TH:i:s';

    /**
     * List all keywords.
     *
     * @return \Chromatic\OrangeDam\Http\Response
     */
    public function listKeywords(array $params = [])
    {
        return $this->client->request(
            'post',
            static::API_BASE_PATH . 'Keywords:Read',
            ['form_params' => $params],
        );
    }

    /**
     * List all keyword relationships.
     *
     * @return \Chromatic\OrangeDam\Http\Response
     */
    public function listKeywordRelationships(array $params = [])
    {
        return $this->client->request(
            'post',
            static::API_BASE_PATH . 'Keywords-links:Read',
            ['form_params' => $params],
        );
    }

    /**
     * List all keyword deletions.
     *
     * @return \Chromatic\OrangeDam\Http\Response
     */
    public function listKeywordDeletions(array $params = [])
    {
        return $this->client->request(
            'post',
            '/API/DataTable/v2.1/Tags.Keyword:Read',
            ['form_params' => $params],
        );
    }

    /**
     * Get data for all document types.
     *
     * @return \Chromatic\OrangeDam\Http\Response
     */
    public function getDocumentData(array $params = [])
    {
        return $this->client->request(
            'post',
            static::API_BASE_PATH . 'Documents.All:Read',
            ['form_params' => $params],
        );
    }
}
