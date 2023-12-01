<?php

namespace app\widgets\HistoryList\events\call;

use app\models\Call;
use app\widgets\HistoryList\events\CommonHistoryEvent;

/**
 * Class CallEvent
 * @package app\widgets\HistoryList\events\call
 */
class CallEvent extends CommonHistoryEvent
{
    /**
     * @return array
     */
    public function renderParams(): array
    {
        $params = parent::renderParams();

        $call = $this->model->call;
        $answered = $call && ($call->status == Call::STATUS_ANSWERED);
        return array_merge($params, [
            'content' => $call->comment ?? '',
            'bodyDatetime' => null,
            'footerDatetime' => $this->model->ins_ts,
            'footer' => isset($call->applicant) ? "Called <span>{$call->applicant->name}</span>" : null,
            'iconClass' => $answered ? 'md-phone bg-green' : 'md-phone-missed bg-red',
            'iconIncome' => $answered && $call->direction == Call::DIRECTION_INCOMING
        ]);
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        $call = $this->model->call;
        if ($call) {
            $body = $call->totalStatusText;
            $totalDisposition = $call->getTotalDisposition(false);
            if (!empty($totalDisposition)) {
                $body .= " <span class='text-grey'>" . $totalDisposition . "</span>";
            }
            return $body;
        }
        return '<i>Deleted</i> ';
    }
}
