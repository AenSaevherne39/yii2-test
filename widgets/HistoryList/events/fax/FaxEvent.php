<?php

namespace app\widgets\HistoryList\events\fax;

use app\models\Fax;
use app\widgets\HistoryList\events\CommonHistoryEvent;
use Yii;
use yii\helpers\Html;

/**
 * Class FaxEvent
 * @package app\widgets\HistoryList\events\fax
 */
class FaxEvent extends CommonHistoryEvent
{
    /**
     * @return array
     */
    public function renderParams(): array
    {
        $params = parent::renderParams();

        $fax = $this->model->fax;
        return array_merge($params, [
            'body' => $this->getBody() . ' - ' . $this->getDocumentUrl($fax),
            'footer' => Yii::t('app', '{type} was sent to {group}', [
                'type' => $fax ? $fax->getTypeText() : 'Fax',
                'group' => $this->getGroupText($fax)
            ]),
            'bodyDatetime' => null,
            'footerDatetime' => $this->model->ins_ts,
            'iconClass' => 'fa-fax bg-green'
        ]);
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->model->eventText;
    }

    /**
     * @param Fax $fax
     *
     * @return string
     */
    private function getGroupText(Fax $fax): string
    {
        if (isset($fax->creditorGroup)) {
            return Html::a($fax->creditorGroup->name, ['creditors/groups'], ['data-pjax' => 0]);
        }
        return '';
    }

    /**
     * @param Fax $fax
     *
     * @return string
     */
    private function getDocumentUrl(Fax $fax): string
    {
        if (!empty($fax->document)) {
            return Html::a(
                Yii::t('app', 'view document'),
                $fax->document->getViewUrl(),
                [
                    'target' => '_blank',
                    'data-pjax' => 0
                ]
            );
        }
        return '';
    }
}
