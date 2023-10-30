<?php

namespace Kanboard\Plugin\TagiAutoActions;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;
use Kanboard\Plugin\TagiAutoActions\Action\TaskRemoveDueDate;


class Plugin extends Base
{
    public function initialize()
    {
        $this->actionManager->register(new TaskRemoveDueDate($this->container));

        // Helper
        $this->helper->register('tagiAutoActionsHelper', '\Kanboard\Plugin\TagiAutoActions\Helper\TagiAutoActionsHelper');

        // Views - Template Hook
        $this->template->hook->attach(
            'template:config:sidebar', 'TagiAutoActions:config/tagiautoactions_config_sidebar');

        // Extra Page - Routes
        $this->route->addRoute('/tagiautoactions/config', 'TagiAutoActionsController', 'showConfig', 'TagiAutoActions');
    }

    public function onStartup()
    {
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__.'/Locale');
    }

    public function getPluginName()
    {
        return 'TagiAutoActions';
    }

    public function getPluginDescription()
    {
        return t('This plugin adds some automatic action to Kanboard.');
    }

    public function getPluginAuthor()
    {
        return 'Tagirijus';
    }

    public function getPluginVersion()
    {
        return '1.0.0';
    }

    public function getCompatibleVersion()
    {
        // Examples:
        // >=1.0.37
        // <1.0.37
        // <=1.0.37
        return '>=1.2.30';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/Tagirijus/TagiAutoActions';
    }


    // DAS GGF NUTZEN!?

    public function colorizeTaskByPriority(&$values)
    {
        $this->logger->info(json_encode($values));
        if (array_key_exists('priority', $values)) {

            if ($values['priority'] == 0) {
                $values['color_id'] = 'green';
            }

            elseif ($values['priority'] == 1) {
                $values['color_id'] = 'yellow';
            }

            elseif ($values['priority'] == 2) {
                $values['color_id'] = 'orange';
            }

            elseif ($values['priority'] == 3) {
                $values['color_id'] = 'pink';
            }
        }

        return $values;
    }
}
