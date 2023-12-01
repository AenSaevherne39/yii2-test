<?php

namespace app\widgets\HistoryList\viewModels\events;

use app\models\Sms;
use Yii;

class SmsEventView extends CommonHistoryEvent
{
    /**
     * @inheritDoc
     */
    public function renderViewParams(): array
    {
        $params = parent::renderViewParams();
        return array_merge($params, [
            'footer' => $this->history->sms->direction == Sms::DIRECTION_INCOMING ?
                Yii::t('app', 'Incoming message from {number}', [
                    'number' => $model->sms->phone_from ?? ''
                ]) : Yii::t('app', 'Sent message to {number}', [
                    'number' => $model->sms->phone_to ?? ''
                ]),
            'iconIncome' => $this->history->sms->direction == Sms::DIRECTION_INCOMING,
            'bodyDatetime' => null,
            'footerDatetime' => $this->history->ins_ts,
            'iconClass' => 'icon-sms bg-dark-blue'
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getBody(): string
    {
        return $this->history->sms->message ? $this->history->sms->message : '';
    }
}
