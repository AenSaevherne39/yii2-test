<?php

namespace app\widgets\HistoryList\viewModels\factories;

use app\enum\HistoryEventTypes;
use app\models\History;
use app\widgets\HistoryList\viewModels\events\CommonHistoryEvent;
use app\widgets\HistoryList\viewModels\events\EventViewInterface;
use Yii;

/**
 * Class HistoryEventFactory
 *
 * @package app\widgets\HistoryList\events
 */
class HistoryEventFactory implements HistoryEventFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createHistoryEvent(History $history): EventViewInterface
    {
        $type = HistoryEventTypes::tryFrom($history->event);
        $viewConfig = $type ? $type->viewClassConfig() : $this->getDefaultConfig();
        /** @var EventViewInterface $entity */
        $entity = Yii::createObject($viewConfig['class'], ['history' => $history]);

        if (!$entity instanceof EventViewInterface) {
            throw new \RuntimeException('Event must implement EventViewInterface interface');
        }
        return $entity;
    }

    /**
     * @return string[]
     */
    protected function getDefaultConfig(): array
    {
        return ['class' => CommonHistoryEvent::class];
    }
}
