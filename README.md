# Magento 2 Google Translate Service Extension

The Collab_GoogleTranslateService module allows You to use its service to translate texts using Google Translate API.

## Basic usage

```php
<?php
...
use Collab\GoogleTranslateService\Service\CloudTranslate;
...
public function __construct(
    protected CloudTranslate $cloudTranslate
) {
}
...
    $text = 'Hello, world!';
    $targetLanguage = 'fr';
    
    $output = $this->cloudTranslate->translate($text, $targetLanguage);
    // $output = 'Bonjour, le monde!'
...
```

Service's `translate` method accepts two string arguments:
- `$text` - text to be translated
- `$targetLanguage` - desired language code

## Installation details
```bash
composer collab/module-google-translate-service
bin/magento setup:upgrade
```

## Configuration
In order to use the service, You need to configure following fields in the `Stores -> Configuration -> Collab Extensions -> Google Translate Service`:

| Tab     | Config Field           | Description                                                                                                                                                                                                        |
|---------|------------------------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| General | API Key (string: Text) | Key should be obtained form Google's Dev Console and Cloud Translation API should be enabled [How To Enable Cloud Translation API](https://console.cloud.google.com/flows/enableapi?apiid=translate.googleapis.com) |
| General | Referer (string: Text) | Referer used by service in order to obtain API responses in case of website limitation setup for Google's API usage.                                                                                       |

Google's Cloud Translation API requires You to have billing enabled so please keep in mind that some additional costs may apply (according to: [Google Cloud Translation Pricing](https://cloud.google.com/translate/pricing)).
