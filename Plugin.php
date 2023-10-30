<?php

namespace Kanboard\Plugin\TagiAutoActions;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;
use Kanboard\Plugin\TagiAutoActions\Action\TaskRemoveDueDate;
use Kanboard\Plugin\TagiAutoActions\Action\PriorityColor;
use Kanboard\Plugin\TagiAutoActions\Action\LastPositionOnColumnMove;


class Plugin extends Base
{
    public function initialize()
    {
        // Auto actions
        $this->actionManager->register(new TaskRemoveDueDate($this->container));
        $this->actionManager->register(new PriorityColor($this->container));
        $this->actionManager->register(new LastPositionOnColumnMove($this->container));

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
}
