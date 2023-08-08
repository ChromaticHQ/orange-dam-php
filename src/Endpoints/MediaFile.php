<?php

namespace Chromatic\OrangeDam\Endpoints;

class MediaFile extends Endpoint
{
    /**
     * API base path.
     *
     * @var string
     */
    protected const API_BASE_PATH = '/webapi/mediafile/';

    /**
     * Retrieve subtitles for an item.
     *
     * @return \Chromatic\OrangeDam\Http\Response
     */
    public function getCaptions(string $videoRecordId, array $params = [])
    {
        return $this->client->request(
            'get',
            static::API_BASE_PATH . 'captions/41Z_v1/' . $videoRecordId,
            $params,
        );
    }
}
