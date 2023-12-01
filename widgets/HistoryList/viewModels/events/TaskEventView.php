<?php

namespace app\widgets\HistoryList\viewModels\events;

class TaskEventView extends CommonHistoryEvent
{
    /**
     * @inheritDoc
     */
    public function renderViewParams(): array
    {
        $params = parent::renderViewParams();
        $task = $this->history->task;
        return array_merge($params, [
            'iconClass' => 'fa-check-square bg-yellow',
            'footerDatetime' => $this->history->ins_ts,
            'bodyDatetime' => null,
            'footer' => !empty($task->customerCreditor->name) ? "Creditor: " . $task->customerCreditor->name : ''
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getBody(): string
    {
        return "{$this->history->eventText}: " . ($this->history->task->title ?? '');
    }
}
