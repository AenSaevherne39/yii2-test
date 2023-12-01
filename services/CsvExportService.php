<?php

namespace app\services;

use app\jobs\ExportCsvJob;
use app\models\search\HistorySearch;
use Yii;
use yii\base\InvalidArgumentException;
use yii\data\ActiveDataProvider;

class CsvExportService implements CsvExportServiceInterface
{
    private const ROWS_LIMIT = 2000;

    /**
     * @inheritDoc
     */
    public function simpleExport(HistorySearch $searchModel, array $params): ActiveDataProvider
    {
        $historyDataProvider = $searchModel->search($params);
        if ($historyDataProvider->getTotalCount() >= self::ROWS_LIMIT) {
            throw new InvalidArgumentException('Sorry, export of more then '
                . self::ROWS_LIMIT
                . ' rows in real time is impossible.'
            );
        }
        return $historyDataProvider;
    }

    /**
     * @inheritDoc
     */
    public function asyncExport(HistorySearch $searchModel, array $params): void
    {
        $emailTo = 'test@test.com';
        $job = ExportCsvJob::create($emailTo, $params);
        Yii::$app->queue->push($job);
    }
}
