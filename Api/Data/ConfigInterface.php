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
    public const XML_PATH_GOOGLE_TRANSLATE_API_KEY = 'collab_googletranslateservice/general/api_key';
    public const XML_PATH_GOOGLE_TRANSLATE_REFERER = 'collab_googletranslateservice/general/referer';

    public function getGoogleTranslateApiKey(): ?string;
    public function getReferer(): ?string;
}
