<?php

namespace Kanboard\Plugin\TagiAutoActions\Controller;




class TagiAutoActionsController extends \Kanboard\Controller\PluginController
{
    /**
     * Show the settings pages of the TagiAutoActions plugin.
     *
     * @return HTML response
     */
    public function showConfig()
    {
        // !!!!!
        // When I want to add new config options, I also have to add them
        // in the WeekHelperHelper.php in the getConfig() Method !
        // !!!!!
        $this->response->html($this->helper->layout->config('TagiAutoActions:config/tagiautoactions_config', $this->helper->tagiAutoActionsHelper->getConfig()));
    }

    /**
     * Save the setting for TagiAutoActions.
     */
    public function saveConfig()
    {
        $form = $this->request->getValues();

        $values = [
            'taa_priority_0_color' => $form['priority_0_color'],
            'taa_priority_1_color' => $form['priority_1_color'],
            'taa_priority_2_color' => $form['priority_2_color'],
            'taa_priority_3_color' => $form['priority_3_color'],
        ];

        $this->languageModel->loadCurrentLanguage();

        if ($this->configModel->save($values)) {
            $this->flash->success(t('Settings saved successfully.'));
        } else {
            $this->flash->failure(t('Unable to save your settings.'));
        }

        return $this->response->redirect($this->helper->url->to('TagiAutoActionsController', 'showConfig', ['plugin' => 'TagiAutoActions']), true);
    }
}