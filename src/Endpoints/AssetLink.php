<?php

namespace Chromatic\OrangeDam\Endpoints;

class AssetLink extends Endpoint {

  /**
   * API base path.
   *
   * @var string
   */
  protected const API_BASE_PATH = 'api/AssetLink/v1.0/';

  /**
   * Create links to formatted assets.
   *
   * @param array $params
   *   Optional parameters.
   *
   * @return \Chromatic\OrangeDam\Http\Response
   */
  public function createFormatLink(array $params = []) {
    return $this->client->request(
      'post',
      static::API_BASE_PATH . 'CreateFormatLink',
      ['form_params' => $params],
    );
  }

}
