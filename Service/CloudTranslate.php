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
use Google\Cloud\Core\Exception\GoogleException;
use Google\Cloud\Core\Exception\ServiceException;
use Google\Cloud\Translate\V2\TranslateClient;

class CloudTranslate
{
    /**
     * @throws GoogleException
     */
    public function __construct(
        protected TranslateClient $translateClient,
        protected ConfigInterface $config
    ) {
        $this->translateClient = new TranslateClient([
            'key' => $this->config->getGoogleTranslateApiKey(),
            'restOptions' => [
                'headers' => [
                    'referer' => $this->config->getReferer()
                ]
            ]
        ]);
    }

    /**
     *
     * @throws ServiceException
     */
    public function translate(string $text, string $targetLanguage): ?string
    {
        $currentLanguage = $this->translateClient->detectLanguage($text);
        if ($currentLanguage['languageCode'] === $targetLanguage) {
            return $text;
        }

        $result = $this->translateClient->translate($text, [
            'target' => $targetLanguage,
        ]);

        return $result['text'];
    }
}
