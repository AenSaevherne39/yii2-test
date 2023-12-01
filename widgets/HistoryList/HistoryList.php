<?php

namespace app\widgets\HistoryList;

use app\models\search\HistorySearch;
use app\widgets\Export\Export;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use Yii;

class HistoryList extends Widget
{
    /**
     * @var HistorySearch
     */
    private $searchModel;

    /**
     * @var string
     */
    public $apiUrl = 'site/export';

    /**
     * HistoryList constructor.
     *
     * @param HistorySearch $search
     * @param array $config
     */
    public function __construct(HistorySearch $search, $config = [])
    {
        $this->searchModel = $search;
        parent::__construct($config);
    }

    /**
     * @return string
     */
    public function run()
    {
        return $this->render('main', [
            'model' => $this->searchModel,
            'linkExport' => $this->getLinkExport(),
            'dataProvider' => $this->searchModel->search(Yii::$app->request->queryParams)
        ]);
    }

    /**
     * @return string
     */
    protected function getLinkExport()
    {
        $params = Yii::$app->getRequest()->getQueryParams();
        $params = ArrayHelper::merge([
            'exportType' => Export::FORMAT_CSV
        ], $params);
        $params[0] = $this->apiUrl;

        return Url::to($params);
    }
}
