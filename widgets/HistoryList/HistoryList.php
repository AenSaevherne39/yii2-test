<?php

namespace app\widgets\HistoryList;

use app\models\search\HistorySearch;
use app\widgets\HistoryList\viewModels\factories\HistoryEventFactory;
use app\widgets\HistoryList\viewModels\factories\HistoryEventFactoryInterface;
use kartik\export\ExportMenu;
use yii\base\Widget;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use Yii;

class HistoryList extends Widget
{
    /**
     * @var string
     */
    public string $apiUrl = 'site/export';

    /**
     * @var ActiveDataProvider
     */
    public ActiveDataProvider $dataProvider;

    /**
     * @var HistorySearch
     */
    private HistorySearch $searchModel;

    /**
     * HistoryList constructor.
     *
     * @param HistorySearch $searchModel
     * @param array $config
     */
    public function __construct(HistorySearch $searchModel, array $config = [])
    {
        $this->searchModel = $searchModel;
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
            'dataProvider' => $this->searchModel->search(Yii::$app->request->queryParams),
        ]);
    }

    /**
     * @return string
     */
    protected function getLinkExport()
    {
        $params = Yii::$app->getRequest()->getQueryParams();
        $params = ArrayHelper::merge(['exportType' => ExportMenu::FORMAT_CSV], $params);
        $params[0] = $this->apiUrl;

        return Url::to($params);
    }
}
