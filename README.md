## Orange DAM PHP API client

The [Orange DAM](https://www.orangelogic.com/products/digital-asset-management-system) APIs allow developers to extend the capabilities of their Orange digital asset management platform. Through calls to its API endpoints, an Orange DAM site can be manipulated and integrated with a CMS or other software/workflows.

This library powers the **[Orange DAM Drupal module](https://www.drupal.org/project/orange_dam)**. For integration with other CMS platforms, see [Future Development](#future-development).

This library enables the following:

- Authentication
- Search content.
- Media retrieval/import.
- Access Keyword data/activity.
- Retrieve media captions.
- List deleted objects.

### Future Development

The Orange DAM API is extensive and this library just scratches the surface of available functionality. Some _ideas_ about where this library and/or the tools that consume it could go next include:

- WordPress plugin.
- Enable upload of content to Orange DAM.
- Access file metadata.
- Document support.
- Create links between documents.
- Integration with Figma asset browser.
- Integration with Adobe Lightroom.
- Integration with Adobe InDesign.
- PDF conversion.
- Extract waveforms from audio content.

_NOTE:_ This library and the associated module(s) that depend on it provide the foundation for a custom integration with Orange DAM. Custom development work will be needed to create a data model in your application, map your data, and/or integrate with the events this module offers.

To further development of this library or its associated modules via sponsorship or to inquire about a custom integration, [contact Chromatic](https://chromatichq.com/contact-us/)!

### Installation

```bash
composer require "chromatic/orange-dam-php"
```

### Usage

```php
use Chromatic\OrangeDam\Factory as OrangeDamApi;

// Create client instance.
$api = new OrangeDamApi([
    'base_path' => 'https://orange-dam-api-server-example.com',
    'query_string' => 'SESSION=XXX',
  ],
  NULL,
  ['http_errors' => FALSE]
);

// Authenticate with OAuth2.0.
$tokens = $api->oAuth2()->getTokensByCode(
  'CLIENT_ID_XXX',
  'CLIENT_SECRET_XXX',
);
$api->getClient()->setOauth2Token($tokens->access_token);

// Make a search request with given parameters.
$params = [
  'query' => 'SystemIdentifier:XXXX',
  'fields' => 'Title,SystemIdentifier,Caption',
  'format' => 'json',
];
$response = $api->search()->search($params);
$content = $response->getData();
```
