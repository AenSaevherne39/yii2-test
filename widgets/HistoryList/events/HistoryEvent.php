<?php

namespace app\widgets\HistoryList\events;

interface HistoryEvent
{
    /**
     * Get view name
     * @return string
     */
    public function getViewName(): string;

    /**
     * Get params for view render
     * @return array
     */
    public function renderParams(): array;

    /**
     * Get event text for view
     * @return string
     */
    public function getBody(): string;
}
