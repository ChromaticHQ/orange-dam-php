## Orange DAM PHP API client

The [Orange DAM](https://www.orangelogic.com/products/digital-asset-management-system) APIs allow developers to safely and securely extend the capabilities of their Orange DAM platform. Through calls to its API endpoints, an Orange DAM site can be manipulated and integrated with other software.

__NOTICE: This library is in pre-release and under active development. It should be considered a preview and not ready for production use.__

### Installation

```bash
composer require "chromatic/orange-dam-php"
```

### Usage

```php
use Chromatic\OrangeDam\Factory as OrangeDamClientFactory;

// Create client instance.
$client = new OrangeDamClientFactory([
    'base_path' => 'https://orange-dam-api-server-example.com',
    'query_string' => 'SESSION=XXX',
  ],
  NULL,
  ['http_errors' => FALSE]
);

// Authenticate with OAuth2.0.
$tokens = $client->oAuth2()->getTokensByCode(
  'CLIENT_ID_XXX',
  'CLIENT_SECRET_XXX',
);
$client->getClient()->setOauth2Token($tokens->access_token);

// Make a search request with given parameters.
$params = [
  'query' => 'SystemIdentifier:XXXX',
  'fields' => 'Title,SystemIdentifier,Caption',
  'format' => 'json',
];
$response = $client->search()->search($params);
$content = $response->getData();
```
