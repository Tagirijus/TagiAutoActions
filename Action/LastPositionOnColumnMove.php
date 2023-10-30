<?php

namespace Kanboard\Plugin\TagiAutoActions\Action;

use Kanboard\Model\TaskModel;
use Kanboard\Action\Base;

/**
 * Move task into last position when moved into a specific column
 *
 * @package action
 * @author  Manuel Senfft
 */
class LastPositionOnColumnMove extends Base
{
    /**
     * Get automatic action description
     *
     * @access public
     * @return string
     */
    public function getDescription()
    {
        return t('Move task to end of column, when it is moved into a specific column.');
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
            TaskModel::EVENT_MOVE_COLUMN,
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
            'column_id' => t('Column'),
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
            'src_column_id',
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
        return $data['task']['column_id'] == $this->getParam('column_id');
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
        return $this->taskPositionModel->moveBottom(
            $task['project_id'], $task['id'], $task['swimlane_id'], $task['column_id']
        );
    }
}