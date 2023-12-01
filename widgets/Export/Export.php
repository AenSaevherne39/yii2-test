<?php

namespace app\widgets\Export;

use kartik\export\ExportMenu;
use Yii;

/**
 * Class Export
 * @package app\widgets\Export
 */
class Export extends ExportMenu
{
    /**
     * @var string
     */
    public $exportType = self::FORMAT_CSV;

    /**
     * @inheritDoc
     */
    public function init()
    {
        if (empty($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
        if (empty($this->exportRequestParam)) {
            $this->exportRequestParam = 'exportFull_' . $this->options['id'];
        }

        Yii::$app->request->setBodyParams([
            Yii::$app->request->methodParam => 'POST',
            $this->exportRequestParam => true,
            $this->exportTypeParam => $this->exportType,
            $this->colSelFlagParam => false,
        ]);
        parent::init();
    }
}
