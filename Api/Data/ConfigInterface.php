<?php
/**
 * @category  Collab
 * @package   Collab\GoogleTtranslateService
 * @author    Marcin Jędrzejewski <m.jedrzejewski@collab.pl>
 * @copyright Collab
 * @license   MIT
 */

declare(strict_types=1);

namespace Collab\GoogleTranslateService\Api\Data;

interface ConfigInterface
{
    public const XML_PATH_GOOGLE_TRANSLATE_PROJECT_ID = 'collab_googletranslateservice/general/project_id';
    public const XML_PATH_GOOGLE_TRANSLATE_SERVICE_ACCOUNT_KEY = 'collab_googletranslateservice/general/service_account_key';
    public const XML_PATH_GOOGLE_TRANSLATE_LOCATION = 'collab_googletranslateservice/general/location';

    public function getProjectId(): ?string;
    public function getServiceAccountKey(): ?string;
    public function getLocation(): string;
}
