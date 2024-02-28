<?php

namespace app\widgets\HistoryList\viewModels\events;

use app\models\Call;

class CallEventView extends CommonHistoryEvent
{
    /**
     * @return array
     */
    public function renderViewParams(): array
    {
        $params = parent::renderViewParams();

        $call = $this->history->call;
        $answered = $call && ($call->status == Call::STATUS_ANSWERED);
        return array_merge($params, [
            'content' => $call->comment ?? '',
            'bodyDatetime' => null,
            'footerDatetime' => $this->history->ins_ts,
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
        $call = $this->history->call;
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
