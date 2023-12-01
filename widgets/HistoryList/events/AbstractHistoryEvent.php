<?php

namespace app\widgets\HistoryList\events;

use app\models\History;

abstract class AbstractHistoryEvent implements HistoryEvent
{
    /**
     * @var History
     */
    protected $model;

    /**
     * @inheritDoc
     */
    public function getBody(): string
    {
        return $this->model->eventText;
    }
}
