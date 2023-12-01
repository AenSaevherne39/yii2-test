<?php

namespace app\widgets\HistoryList\viewModels\events;

use app\models\Customer;
use app\models\History;

class CustomerEvent extends AbstractEventView
{
    /**
     * @param History $history
     * @param string $attribute event text would be based on this attribute
     */
    public function __construct(
        public History $history,
        public string $attribute = 'type'
    ) {}

    /**
     * @inheritDoc
     */
    public function getViewName(): string
    {
        return '_item_statuses_change';
    }

    /**
     * @inheritDoc
     */
    public function renderViewParams(): array
    {
        return [
            'model' => $this->history,
            'oldValue' => $this->getNewValue(),
            'newValue' => $this->getOldValue(),
        ];
    }

    /**
     * @inheritDoc
     */
    public function getBody(): string
    {
        $oldValue = $this->getOldValue();
        $newValue = $this->getNewValue();
        return sprintf('%s %s to %s',
            $this->history->eventText,
            empty($oldValue) ? 'not set' : $oldValue,
            empty($newValue) ? 'not set' : $newValue
        );
    }

    /**
     * @return string
     */
    protected function getOldValue()
    {
        return Customer::getTypeTextByType($this->history->getDetailOldValue($this->attribute));
    }

    /**
     * @return string
     */
    protected function getNewValue()
    {
        return Customer::getTypeTextByType($this->history->getDetailNewValue($this->attribute));
    }
}

