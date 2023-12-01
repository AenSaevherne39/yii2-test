<?php

namespace app\widgets\HistoryList\events;

use app\models\History;

class CommonHistoryEvent extends AbstractHistoryEvent
{
    /**
     * @param History $model
     */
    public function __construct(History $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritDoc
     */
    public function getViewName(): string
    {
        return '_item_common';
    }

    /**
     * @inheritDoc
     */
    public function renderParams(): array
    {
        return [
            'user' => $this->model->user,
            'body' => $this->getBody(),
            'bodyDatetime' => $this->model->ins_ts,
            'iconClass' => 'fa-gear bg-purple-light'
        ];
    }
}
