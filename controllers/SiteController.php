<?php

namespace app\controllers;

use app\models\search\HistorySearch;
use app\services\CsvExportService;
use app\widgets\HistoryList\viewModels\factories\HistoryEventFactory;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\Controller;
use yii\web\Response;

class SiteController extends Controller
{
    /**
     * @var CsvExportService
     */
    private CsvExportService $exportService;

    /**
     * @var HistoryEventFactory
     */
    private HistoryEventFactory $factory;

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    /**
     * @inheritDoc
     * @param CsvExportService $exportService
     */
    public function __construct(
        $id,
        $module,
        CsvExportService $exportService,
        HistoryEventFactory $factory,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
        $this->exportService = $exportService;
        $this->factory = $factory;
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        return $this->render('index');
    }


    /**
     * @param string $exportType
     *
     * @return string|Response
     */
    public function actionExport(string $exportType): Response|string
    {
        $params = Yii::$app->request->getQueryParams();
        $searchModel = new HistorySearch();
        try {
            $dataProvider = $this->exportService->simpleExport($searchModel, $params);
            return $this->render('export', [
                'dataProvider' => $dataProvider,
                'exportType' => $exportType,
                'model' => $searchModel,
                'filename' => 'history-' . time(),
                'factory' => $this->factory,
            ]);
        } catch (InvalidArgumentException $e) {
            Yii::$app->session->addFlash('info', Yii::t('app', $e->getMessage()));
            Yii::$app->session->addFlash('info', Yii::t('app', 'You will receive report via email'));
            $this->exportService->asyncExport($searchModel, $params);
            $params[0] = 'site/index';
            return $this->redirect($params);
        }
    }
}
