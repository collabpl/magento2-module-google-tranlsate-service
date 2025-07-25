<?php
/**
 * @category  Collab
 * @package   Collab\GoogleTtranslateService
 * @author    Marcin Jędrzejewski <m.jedrzejewski@collab.pl>
 * @copyright Collab
 * @license   MIT
 */

declare(strict_types=1);

namespace Collab\GoogleTranslateService\Service;

use Collab\GoogleTranslateService\Api\Data\ConfigInterface;
use Google\Cloud\Translate\V3\TranslationServiceClient;
use Google\ApiCore\ApiException;
use Psr\Log\LoggerInterface;

class CloudTranslate
{
    private ?TranslationServiceClient $translationServiceClient = null;

    public function __construct(
        protected ConfigInterface $config,
        protected LoggerInterface $logger
    ) {
    }

    /**
     * Get or create translation service client
     * 
     * @return TranslationServiceClient
     * @throws \Exception
     */
    private function getTranslationServiceClient(): TranslationServiceClient
    {
        if ($this->translationServiceClient === null) {
            $serviceAccountKey = $this->config->getServiceAccountKey();
            if (!$serviceAccountKey) {
                throw new \Exception('Google Cloud service account key is not configured.');
            }

            // Decode the service account key JSON
            $keyData = json_decode($serviceAccountKey, true);
            if (!$keyData) {
                throw new \Exception('Invalid service account key JSON format.');
            }

            $this->translationServiceClient = new TranslationServiceClient([
                'credentials' => $keyData
            ]);
        }

        return $this->translationServiceClient;
    }

    /**
     * Translate text using Google Translate API v3
     *
     * @param string $text
     * @param string $targetLanguage
     * @param string|null $sourceLanguage
     * @return string|null
     * @throws ApiException
     */
    public function translate(string $text, string $targetLanguage, ?string $sourceLanguage = null): ?string
    {
        try {
            $projectId = $this->config->getProjectId();
            if (!$projectId) {
                throw new \Exception('Google Cloud project ID is not configured.');
            }

            $location = $this->config->getLocation();
            $client = $this->getTranslationServiceClient();
            
            // Format the parent path
            $parent = $client->locationName($projectId, $location);

            // Prepare the request
            $request = [
                'parent' => $parent,
                'contents' => [$text],
                'target_language_code' => $targetLanguage,
            ];

            // Add source language if provided
            if ($sourceLanguage) {
                $request['source_language_code'] = $sourceLanguage;
            }

            // Make the translation request
            $response = $client->translateText($request);
            $translations = $response->getTranslations();

            if (count($translations) > 0) {
                return $translations[0]->getTranslatedText();
            }

            return null;
        } catch (ApiException $e) {
            $this->logger->error('Google Translate API error: ' . $e->getMessage(), [
                'text' => $text,
                'target_language' => $targetLanguage,
                'source_language' => $sourceLanguage
            ]);
            throw $e;
        } catch (\Exception $e) {
            $this->logger->error('Translation service error: ' . $e->getMessage(), [
                'text' => $text,
                'target_language' => $targetLanguage,
                'source_language' => $sourceLanguage
            ]);
            throw $e;
        }
    }

    /**
     * Detect language of the given text
     *
     * @param string $text
     * @return string|null
     * @throws ApiException
     */
    public function detectLanguage(string $text): ?string
    {
        try {
            $projectId = $this->config->getProjectId();
            if (!$projectId) {
                throw new \Exception('Google Cloud project ID is not configured.');
            }

            $location = $this->config->getLocation();
            $client = $this->getTranslationServiceClient();
            
            // Format the parent path
            $parent = $client->locationName($projectId, $location);

            // Make the detect language request
            $response = $client->detectLanguage([
                'parent' => $parent,
                'content' => $text
            ]);

            $languages = $response->getLanguages();
            if (count($languages) > 0) {
                return $languages[0]->getLanguageCode();
            }

            return null;
        } catch (ApiException $e) {
            $this->logger->error('Google Translate language detection error: ' . $e->getMessage(), [
                'text' => $text
            ]);
            throw $e;
        } catch (\Exception $e) {
            $this->logger->error('Language detection service error: ' . $e->getMessage(), [
                'text' => $text
            ]);
            throw $e;
        }
    }

    /**
     * Get supported languages
     *
     * @return array
     * @throws ApiException
     */
    public function getSupportedLanguages(): array
    {
        try {
            $projectId = $this->config->getProjectId();
            if (!$projectId) {
                throw new \Exception('Google Cloud project ID is not configured.');
            }

            $location = $this->config->getLocation();
            $client = $this->getTranslationServiceClient();
            
            // Format the parent path
            $parent = $client->locationName($projectId, $location);

            // Get supported languages
            $response = $client->getSupportedLanguages([
                'parent' => $parent
            ]);

            $languages = [];
            foreach ($response->getLanguages() as $language) {
                $languages[] = [
                    'language_code' => $language->getLanguageCode(),
                    'display_name' => $language->getDisplayName()
                ];
            }

            return $languages;
        } catch (ApiException $e) {
            $this->logger->error('Google Translate get supported languages error: ' . $e->getMessage());
            throw $e;
        } catch (\Exception $e) {
            $this->logger->error('Get supported languages service error: ' . $e->getMessage());
            throw $e;
        }
    }
}
