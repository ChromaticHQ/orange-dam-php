<?php

namespace Chromatic\OrangeDam\Endpoints;

class AssetFile extends Endpoint
{
    /**
     * API base path.
     *
     * @var string
     */
    protected const API_BASE_PATH = '/webapi/mediafile/assetfile/';

    /**
     * Create links to formatted assets.
     *
     * @param string $format
     *   An Orange Dam asset format, such as TR1, or TR1_WATERMARKED.
     * @param string $sort
     *   The sort order of found assets. If you are using an identifer, the
     *   result should just be one listing. The API default is 'Newest First'.
     * @param array $queryConditions
     *   An array of searchkeys and searchvalues with which to perform a Search
     *   API syntax freetext search.
     *   Example: ['docType' => 'Image',  'Test.UserFieldA' => 'ZZZ']
     *
     * @see https://jfklibrary5355prod.orangelogic.com/swagger/index.html?
     *   urls.primaryName=mediafile#/AssetFile/
     *   get_webapi_mediafile_assetfile_getassetfile_42R_v1
     *
     * @return \Chromatic\OrangeDam\Http\Response
     */
    public function getFormatFile(string $format, string $sort = '', array $queryConditions = [])
    {
        $query = [
          'Format' => $format,
        ];
        if ($sort) {
            $query['Sort'] = $sort;
        }
        if ($queryConditions) {
            array_walk($queryConditions, fn (&$v, $k) => $v = "$k:$v");
            $query['QueryConditions'] = implode(' AND ', $queryConditions);
        }

        return $this->client->request(
            method: 'get',
            endpoint: static::API_BASE_PATH . 'getassetfile_42R_v1',
            query_string: http_build_query(data: $query, encoding_type: PHP_QUERY_RFC3986),
        );
    }
}
