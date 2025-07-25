# Magento 2 Google Translate Service Extension

The Collab_GoogleTranslateService module allows You to use its service to translate texts using Google Translate API v3.

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
    
    // Basic translation
    $output = $this->cloudTranslate->translate($text, $targetLanguage);
    // $output = 'Bonjour le monde !'
    
    // Translation with source language specified
    $output = $this->cloudTranslate->translate($text, $targetLanguage, 'en');
    
    // Detect language
    $detectedLanguage = $this->cloudTranslate->detectLanguage($text);
    // $detectedLanguage = 'en'
    
    // Get supported languages
    $supportedLanguages = $this->cloudTranslate->getSupportedLanguages();
...
```

Service's `translate` method accepts three arguments:
- `$text` - text to be translated
- `$targetLanguage` - desired language code
- `$sourceLanguage` - (optional) source language code

## Installation details
```bash
composer collab/module-google-translate-service
bin/magento setup:upgrade
```

## Configuration
In order to use the service, You need to configure following fields in the `Stores -> Configuration -> Collab Extensions -> Google Translate Service`:

| Tab     | Config Field                   | Description                                                                                                                                                                                                        |
|---------|--------------------------------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| General | Google Cloud Project ID        | Your Google Cloud project ID. [Find your project ID](https://console.cloud.google.com/)                                                                                                                         |
| General | Service Account Key (JSON)     | The complete JSON content of your service account key file. [Learn how to create service account](https://cloud.google.com/translate/docs/setup)                                                               |
| General | Location                       | The location for your translation requests. Use 'global' for most cases.                                                                                                                                         |

## Setup Instructions

1. **Enable the Cloud Translation API** in your Google Cloud Console: [Enable API](https://console.cloud.google.com/flows/enableapi?apiid=translate.googleapis.com)

2. **Create a Service Account**:
   - Go to [Google Cloud Console](https://console.cloud.google.com/)
   - Navigate to "IAM & Admin" → "Service Accounts"
   - Click "Create Service Account"
   - Grant the "Cloud Translation API User" role
   - Create and download the JSON key file

3. **Configure the Module**:
   - Paste your project ID in the "Google Cloud Project ID" field
   - Copy the entire contents of the JSON key file into the "Service Account Key (JSON)" field
   - Select your preferred location (use 'global' if unsure)

Google's Cloud Translation API requires You to have billing enabled so please keep in mind that some additional costs may apply (according to: [Google Cloud Translation Pricing](https://cloud.google.com/translate/pricing)).
