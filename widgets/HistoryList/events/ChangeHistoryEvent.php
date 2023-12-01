<?php

namespace app\widgets\HistoryList\events;

use app\models\Customer;
use app\models\History;

class ChangeHistoryEvent extends AbstractHistoryEvent
{
    /**
     * Event text would be based on this attribute
     * @var string
     */
    protected $attribute;

    /**
     * @param History $model
     * @param string $attribute
     */
    public function __construct(History $model, $attribute = 'type')
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }

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
    public function renderParams(): array
    {
        return [
            'model' => $this->model,
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
            $this->model->eventText,
            empty($oldValue) ? 'not set' : $oldValue,
            empty($newValue) ? 'not set' : $newValue
        );
    }

    /**
     * @return string
     */
    protected function getOldValue()
    {
        return Customer::getTypeTextByType($this->model->getDetailOldValue($this->attribute));
    }

    /**
     * @return string
     */
    protected function getNewValue()
    {
        return Customer::getTypeTextByType($this->model->getDetailNewValue($this->attribute));
    }
}
