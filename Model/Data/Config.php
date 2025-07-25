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

    public function getProjectId(): ?string
    {
        return $this->scopeConfig->getValue(self::XML_PATH_GOOGLE_TRANSLATE_PROJECT_ID, ScopeInterface::SCOPE_STORE);
    }

    public function getServiceAccountKey(): ?string
    {
        return $this->encryptor->decrypt(
            $this->scopeConfig->getValue(self::XML_PATH_GOOGLE_TRANSLATE_SERVICE_ACCOUNT_KEY, ScopeInterface::SCOPE_STORE)
        );
    }

    public function getLocation(): string
    {
        return $this->scopeConfig->getValue(self::XML_PATH_GOOGLE_TRANSLATE_LOCATION, ScopeInterface::SCOPE_STORE) ?? 'global';
    }
}
