<?php

namespace Chromatic\OrangeDam\Endpoints;

use Chromatic\OrangeDam\Exceptions\OrangeDamException;

/**
 * Class for authentication with OAuth2.0.
 *
 * Returns token data (token and experience date) by given client_id and client_secret.
 */
class OAuth2 extends Endpoint {
  protected $endpoint = '/webapi/security/clientcredentialsauthentication/authenticate_46H_v1';

  /**
   * Get OAuth 2.0 Access Token.
   *
   * @param string $clientId
   *   The Client ID of your app.
   * @param string $clientSecret
   *   The Client Secret of your app.
   *
   * @return object
   *   An object with token data (token, expiration data).
   */
  public function getTokensByCode(string $clientId, string $clientSecret) {
    $options['form_params'] = [
      'grant_type' => 'client_credentials',
      'client_id' => $clientId,
      'client_secret' => $clientSecret
    ];

    $options['headers']['content-type'] = 'application/x-www-form-urlencoded';

    $response = $this->client->request('post', $this->endpoint, $options, '', false);
    $data = $response->getData();

    if (empty($data->access_token)) {
      throw new OrangeDamException('There is a problem requesting OAuth2.0 token.');
    }

    return $data;
  }

}
