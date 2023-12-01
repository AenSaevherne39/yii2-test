<?php

namespace app\widgets\HistoryList\events\sms;

use app\models\Sms;
use app\widgets\HistoryList\events\CommonHistoryEvent;
use Yii;

/**
 * Class SmsEvent
 * @package app\widgets\HistoryList\events\sms
 */
class SmsEvent extends CommonHistoryEvent
{
    /**
     * @inheritDoc
     */
    public function renderParams(): array
    {
        $params = parent::renderParams();

        return array_merge($params, [
            'footer' => $this->model->sms->direction == Sms::DIRECTION_INCOMING ?
                Yii::t('app', 'Incoming message from {number}', [
                    'number' => $model->sms->phone_from ?? ''
                ]) : Yii::t('app', 'Sent message to {number}', [
                    'number' => $model->sms->phone_to ?? ''
                ]),
            'iconIncome' => $this->model->sms->direction == Sms::DIRECTION_INCOMING,
            'bodyDatetime' => null,
            'footerDatetime' => $this->model->ins_ts,
            'iconClass' => 'icon-sms bg-dark-blue'
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getBody(): string
    {
        return $this->model->sms->message ? $this->model->sms->message : '';
    }
}
