<?php

namespace Kanboard\Plugin\TagiAutoActions\Action;

use Kanboard\Model\TaskModel;
use Kanboard\Action\Base;

/**
 * Rename Task Title
 *
 * @package action
 * @author  Manuel Senfft
 */
class PriorityColor extends Base
{
    /**
     * Get automatic action description
     *
     * @access public
     * @return string
     */
    public function getDescription()
    {
        return t('Set color based on priority of the task. Yet with 0-3 priority levels assigned in the config.');
    }

    /**
     * Get the list of compatible events
     *
     * @access public
     * @return array
     */
    public function getCompatibleEvents()
    {
        return array(
            TaskModel::EVENT_CREATE_UPDATE,
        );
    }

    /**
     * Get the required parameter for the action (defined by the user)
     *
     * @access public
     * @return array
     */
    public function getActionRequiredParameters()
    {
        return array(
            // 'column_id' => t('Column'),
        );
    }

    /**
     * Get the required parameter for the event
     *
     * @access public
     * @return string[]
     */
    public function getEventRequiredParameters()
    {
        return array(
            'task_id',
            // 'src_column_id',
        );
    }

    /**
     * Check if the event data meet the action condition
     *
     * @access public
     * @param  array   $data   Event data dictionary
     * @return bool
     */
    public function hasRequiredCondition(array $data)
    {
        return true;
        // return $data['task']['column_id'] == $this->getParam('column_id');
    }

    /**
     * Execute the action
     *
     * @access public
     * @param  array   $data   Event data dictionary
     * @return bool            True if the action was executed or false when not executed
     */
    public function doAction(array $data)
    {
        if (array_key_exists('task', $data)) {
            $task = $data['task'];
        } else {
            return false;
        }
        if (array_key_exists('priority', $task)) {

            if ($task['priority'] == 0) {
                $color = $this->configModel->get('taa_priority_0_color', 'green');
            }

            elseif ($task['priority'] == 1) {
                $color = $this->configModel->get('taa_priority_1_color', 'yellow');
            }

            elseif ($task['priority'] == 2) {
                $color = $this->configModel->get('taa_priority_2_color', 'orange');
            }

            elseif ($task['priority'] == 3) {
                $color = $this->configModel->get('taa_priority_3_color', 'pink');
            }
            return $this->taskModificationModel->update(
                [
                    'id' => $task['id'],
                    'color_id' => $color,
                ]
            );
        } else {
            return false;
        }
    }
}