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
     * @return \Chromatic\OrangeDam\Http\Response
     */
    public function getFormatFile(string $format, string $sort = '', array $queryConditions = [])
    {
        // @todo Is it over-reach to validate the format against some retrieved
        // list of formats?
        $query_string = "Format=$format";
        if ($sort) {
            $query_string .= '&Sort=' . rawurlencode($sort);
        }
        if ($queryConditions) {
            $query_string .= '&QueryConditions=';
            array_walk($queryConditions, fn (&$v, $k) => $v = "$k:$v");
            $query_string .= rawurlencode(implode(' AND ', $queryConditions));
        }
        return $this->client->request(
            method: 'get',
            endpoint: static::API_BASE_PATH . 'getassetfile_42R_v1',
            query_string: $query_string,
        );
    }
}
