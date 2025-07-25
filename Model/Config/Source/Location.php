<?php
/**
 * @category  Collab
 * @package   Collab\GoogleTtranslateService
 * @author    Marcin Jędrzejewski <m.jedrzejewski@collab.pl>
 * @copyright Collab
 * @license   MIT
 */

declare(strict_types=1);

namespace Collab\GoogleTranslateService\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Location implements OptionSourceInterface
{
    /**
     * Return array of options as value-label pairs
     *
     * @return array
     */
    public function toOptionArray(): array
    {
        return [
            ['value' => 'global', 'label' => __('Global')],
            ['value' => 'us-central1', 'label' => __('US Central 1')],
            ['value' => 'europe-west1', 'label' => __('Europe West 1')],
            ['value' => 'asia-northeast1', 'label' => __('Asia Northeast 1')],
            ['value' => 'us-east1', 'label' => __('US East 1')],
            ['value' => 'us-west1', 'label' => __('US West 1')],
            ['value' => 'europe-west4', 'label' => __('Europe West 4')],
            ['value' => 'asia-east1', 'label' => __('Asia East 1')],
        ];
    }
}
