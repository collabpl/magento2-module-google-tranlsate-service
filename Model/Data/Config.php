<?php
/**
 * @category  Collab
 * @package   Collab\GoogleTtranslateService
 * @author    Marcin Jędrzejewski <m.jedrzejewski@collab.pl>
 * @copyright Collab
 * @license   MIT
 */

declare(strict_types=1);

namespace Collab\GoogleTranslateService\Model\Data;

use Collab\GoogleTranslateService\Api\Data\ConfigInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Encryption\EncryptorInterface;
use Magento\Store\Model\ScopeInterface;

class Config extends DataObject implements ConfigInterface
{
    public function __construct(
        protected ScopeConfigInterface $scopeConfig,
        protected EncryptorInterface $encryptor,
        array $data = []
    ) {
        parent::__construct($data);
    }

    public function getGoogleTranslateApiKey(): ?string
    {
        return $this->encryptor->decrypt(
            $this->scopeConfig->getValue(self::XML_PATH_GOOGLE_TRANSLATE_API_KEY, ScopeInterface::SCOPE_STORE)
        );
    }

    public function getReferer(): ?string
    {
        return $this->scopeConfig->getValue(self::XML_PATH_GOOGLE_TRANSLATE_REFERER, ScopeInterface::SCOPE_STORE);
    }
}
