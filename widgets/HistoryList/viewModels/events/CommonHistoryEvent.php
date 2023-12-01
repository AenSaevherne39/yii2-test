<?php

namespace app\widgets\HistoryList\viewModels\events;

use app\models\History;

class CommonHistoryEvent extends AbstractEventView
{
    /**
     * @param History $history
     */
    public function __construct(
        protected History $history
    ) {}

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
    public function renderViewParams(): array
    {
        return [
            'user' => $this->history->user,
            'body' => $this->getBody(),
            'bodyDatetime' => $this->history->ins_ts,
            'iconClass' => 'fa-gear bg-purple-light'
        ];
    }

    /**
     * @inheritDoc
     */
    public function getBody(): string
    {
        return $this->history->eventText;
    }
}
