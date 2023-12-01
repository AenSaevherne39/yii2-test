<?php

namespace app\widgets\HistoryList\events;

use app\models\History;
use app\widgets\HistoryList\events\call\CallEvent;
use app\widgets\HistoryList\events\customer\CustomerEvent;
use app\widgets\HistoryList\events\fax\FaxEvent;
use app\widgets\HistoryList\events\sms\SmsEvent;
use app\widgets\HistoryList\events\task\TaskEvent;

/**
 * Class HistoryEventFactory
 *
 * @package app\widgets\HistoryList\events
 */
class HistoryEventFactory
{
    /**
     * @var History
     */
    protected $model;

    /**
     * HistoryEventFactory constructor.
     *
     * @param History $model
     */
    public function __construct(History $model)
    {
        $this->model = $model;
    }

    /**
     * Create new history event object based on history event name
     * @return HistoryEvent
     */
    public function createHistoryEvent(): HistoryEvent
    {
        switch ($this->model->event) {
            case History::EVENT_CREATED_TASK:
            case History::EVENT_UPDATED_TASK:
            case History::EVENT_COMPLETED_TASK:
                return $this->createTaskEvent();
            case History::EVENT_INCOMING_CALL:
            case History::EVENT_OUTGOING_CALL:
                return $this->createCallEvent();
            case History::EVENT_INCOMING_SMS:
            case History::EVENT_OUTGOING_SMS:
                return $this->createSmsEvent();
            case History::EVENT_INCOMING_FAX:
            case History::EVENT_OUTGOING_FAX:
                return $this->createFaxEvent();
            case History::EVENT_CUSTOMER_CHANGE_QUALITY:
            case History::EVENT_CUSTOMER_CHANGE_TYPE:
                return $this->createCustomerEvent();
            default:
                return $this->createDefault();
        }
    }

    /**
     * @return HistoryEvent
     */
    protected function createCallEvent(): HistoryEvent
    {
        return new CallEvent($this->model);
    }

    /**
     * @return HistoryEvent
     */
    protected function createFaxEvent(): HistoryEvent
    {
        return new FaxEvent($this->model);
    }

    /**
     * @return HistoryEvent
     */
    protected function createTaskEvent(): HistoryEvent
    {
        return new TaskEvent($this->model);
    }

    /**
     * @return HistoryEvent
     */
    protected function createSmsEvent(): HistoryEvent
    {
        return new SmsEvent($this->model);
    }

    /**
     * @return HistoryEvent
     */
    protected function createCustomerEvent(): HistoryEvent
    {
        $attribute = $this->model->event === History::EVENT_CUSTOMER_CHANGE_TYPE ? 'type' : 'quality';
        return new CustomerEvent($this->model, $attribute);
    }

    /**
     * @return CommonHistoryEvent
     */
    protected function createDefault()
    {
        return new CommonHistoryEvent($this->model);
    }
}
