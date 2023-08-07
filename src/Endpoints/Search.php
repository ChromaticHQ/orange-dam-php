<?php

namespace Chromatic\OrangeDam\Endpoints;

class Search extends Endpoint
{
    /**
     * API base path.
     *
     * @var string
     */
    protected const API_BASE_PATH = '/API/search/v3.0/';

    /**
     * The Orange DAM API date format.
     *
     * Use the format YYYY-MM-DDTHH.MM.SS (e.g. 1977-04-22T16.00.00), using the
     * 24-hour clock.
     */
    final public const DATE_FORMAT = 'Y-m-d\TH.i.s';

    /**
     * Make search request.
     *
     * @return \Chromatic\OrangeDam\Http\Response
     */
    public function search(array $params = [], array $options = [])
    {
        $options['form_params'] = $params;
        return $this->client->request(
            'post',
            static::API_BASE_PATH . 'search',
            $options,
        );
    }

    /**
     * List all fields.
     *
     * @return \Chromatic\OrangeDam\Http\Response
     */
    public function listFields(array $params = [])
    {
        return $this->client->request(
            'post',
            static::API_BASE_PATH . 'ListFields',
            ['form_params' => $params],
        );
    }
}
