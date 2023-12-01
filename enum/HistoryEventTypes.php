<?php

namespace app\enum;

use app\widgets\HistoryList\viewModels\events\CallEventView;
use app\widgets\HistoryList\viewModels\events\CustomerEvent;
use app\widgets\HistoryList\viewModels\events\FaxEventView;
use app\widgets\HistoryList\viewModels\events\SmsEventView;
use app\widgets\HistoryList\viewModels\events\TaskEventView;
use Yii;

enum HistoryEventTypes: string
{
    case EVENT_CREATED_TASK = 'created_task';
    case EVENT_UPDATED_TASK = 'updated_task';
    case EVENT_COMPLETED_TASK = 'completed_task';
    case EVENT_INCOMING_SMS = 'incoming_sms';
    case EVENT_OUTGOING_SMS = 'outgoing_sms';
    case EVENT_INCOMING_CALL = 'incoming_call';
    case EVENT_OUTGOING_CALL = 'outgoing_call';
    case EVENT_INCOMING_FAX = 'incoming_fax';
    case EVENT_OUTGOING_FAX = 'outgoing_fax';
    case EVENT_CUSTOMER_CHANGE_TYPE = 'customer_change_type';
    case EVENT_CUSTOMER_CHANGE_QUALITY = 'customer_change_quality';

    /**
     * @return string
     */
    public function text(): string
    {
        return match($this)
        {
            self::EVENT_CREATED_TASK => Yii::t('app', 'Task created'),
            self::EVENT_UPDATED_TASK => Yii::t('app', 'Task updated'),
            self::EVENT_COMPLETED_TASK => Yii::t('app', 'Task completed'),
            self::EVENT_INCOMING_SMS => Yii::t('app', 'Incoming message'),
            self::EVENT_OUTGOING_SMS => Yii::t('app', 'Outgoing message'),
            self::EVENT_CUSTOMER_CHANGE_TYPE => Yii::t('app', 'Type changed'),
            self::EVENT_CUSTOMER_CHANGE_QUALITY => Yii::t('app', 'Property changed'),
            self::EVENT_OUTGOING_CALL => Yii::t('app', 'Outgoing call'),
            self::EVENT_INCOMING_CALL => Yii::t('app', 'Incoming call'),
            self::EVENT_INCOMING_FAX => Yii::t('app', 'Incoming fax'),
            self::EVENT_OUTGOING_FAX => Yii::t('app', 'Outgoing fax'),
        };
    }

    /**
     * Return config for view class
     * @return string[]
     */
    public function viewClassConfig(): array
    {
        return match ($this) {
            self::EVENT_CREATED_TASK, self::EVENT_UPDATED_TASK, self::EVENT_COMPLETED_TASK => ['class' => TaskEventView::class],
            self::EVENT_INCOMING_CALL, self::EVENT_OUTGOING_CALL => ['class' => CallEventView::class],
            self::EVENT_INCOMING_SMS, self::EVENT_OUTGOING_SMS => ['class' => SmsEventView::class],
            self::EVENT_INCOMING_FAX, self::EVENT_OUTGOING_FAX => ['class' => FaxEventView::class],
            self::EVENT_CUSTOMER_CHANGE_QUALITY => ['class' => CustomerEvent::class, 'attribute' => 'quality'],
            self::EVENT_CUSTOMER_CHANGE_TYPE => ['class' => CustomerEvent::class, 'attribute' => 'type'],
        };
    }
}


