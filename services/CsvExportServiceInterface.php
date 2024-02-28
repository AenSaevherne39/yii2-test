<?php

namespace app\services;

use app\models\search\HistorySearch;
use yii\data\ActiveDataProvider;

interface CsvExportServiceInterface
{
    /**
     * @param HistorySearch $searchModel
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function simpleExport(HistorySearch $searchModel, array $params): ActiveDataProvider;

    /**
     * Creat asyn job to calculate csv data and send file via email
     * @param HistorySearch $searchModel
     * @param array $params
     */
    public function asyncExport(HistorySearch $searchModel, array $params): void;
}
