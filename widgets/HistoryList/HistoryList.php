<?php

namespace app\widgets\HistoryList;

use app\models\search\HistorySearch;
use app\widgets\HistoryList\viewModels\factories\HistoryEventFactory;
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
     * @var HistorySearch
     */
    private HistorySearch $searchModel;
    private HistoryEventFactory $factory;

    /**
     * HistoryList constructor.
     *
     * @param HistorySearch $searchModel
     * @param array $config
     */
    public function __construct(HistorySearch $searchModel, HistoryEventFactory $factory, array $config = [])
    {
        $this->searchModel = $searchModel;
        $this->factory = $factory;
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
            'factory' => $this->factory,
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
