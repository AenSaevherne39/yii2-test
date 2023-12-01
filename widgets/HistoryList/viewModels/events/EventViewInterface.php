<?php

namespace app\widgets\HistoryList\viewModels\events;

interface EventViewInterface
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
    public function renderViewParams(): array;

    /**
     * Get body text
     * @return string
     */
    public function getBody(): string;
}
