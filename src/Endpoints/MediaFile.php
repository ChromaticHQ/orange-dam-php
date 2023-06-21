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
     * @param string $video_id
     *   The item's record ID.
     * @param array $params
     *   Optional parameters.
     *
     * @return \Chromatic\OrangeDam\Http\Response
     */
    public function getCaptions(string $video_id, array $params = [])
    {
        return $this->client->request(
            'get',
            static::API_BASE_PATH . 'captions/41Z_v1/' . $video_id,
            $params,
        );
    }
}
