<?php

namespace app\widgets\HistoryList\viewModels\factories;

use app\models\History;
use app\widgets\HistoryList\viewModels\events\EventViewInterface;
use yii\base\InvalidConfigException;

interface HistoryEventFactoryInterface
{
    /**
     * Create new history event object based on history event name
     *
     * @param History $history
     *
     * @return EventViewInterface
     * @throws InvalidConfigException
     */
    public function createHistoryEvent(History $history): EventViewInterface;
}
