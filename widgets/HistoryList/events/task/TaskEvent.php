<?php

namespace app\widgets\HistoryList\events\task;

use app\widgets\HistoryList\events\CommonHistoryEvent;

/**
 * Class TaskEvent
 * @package app\widgets\HistoryList\events\task
 */
class TaskEvent extends CommonHistoryEvent
{
    /**
     * @inheritDoc
     */
    public function renderParams(): array
    {
        $params = parent::renderParams();
        $task = $this->model->task;
        return array_merge($params, [
            'iconClass' => 'fa-check-square bg-yellow',
            'footerDatetime' => $this->model->ins_ts,
            'bodyDatetime' => null,
            'footer' => !empty($task->customerCreditor->name) ? "Creditor: " . $task->customerCreditor->name : ''
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getBody(): string
    {
        return "{$this->model->eventText}: " . ($this->model->task->title ?? '');
    }
}
