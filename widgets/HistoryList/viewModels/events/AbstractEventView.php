<?php

namespace app\widgets\HistoryList\viewModels\events;

use app\models\History;

abstract class AbstractEventView implements EventViewInterface
{
    /**
     * @var History
     */
    protected History $history;

    /**
     * @inheritDoc
     */
    public function getBody(): string
    {
        return $this->history->eventText;
    }

    /**
     * @param History $history
     */
    public function setHistory(History $history): void
    {
        $this->history = $history;
    }
}
