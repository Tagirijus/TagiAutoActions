<?php

namespace Kanboard\Plugin\TagiAutoActions\Helper;

use Kanboard\Core\Base;


class TagiAutoActionsHelper extends Base
{

    /**
     * Get configuration for plugin as array.
     *
     * @return array
     */
    public function getConfig()
    {
        return [
            'title' => t('TagiAutoActions') . ' &gt; ' . t('Settings'),
            'priority_0_color' => $this->configModel->get('taa_priority_0_color', 'green'),
            'priority_1_color' => $this->configModel->get('taa_priority_1_color', 'yellow'),
            'priority_2_color' => $this->configModel->get('taa_priority_2_color', 'orange'),
            'priority_3_color' => $this->configModel->get('taa_priority_3_color', 'pink'),
        ];
    }
}
