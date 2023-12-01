<?php

use app\models\search\HistorySearch;
use app\widgets\HistoryList\viewModels\factories\HistoryEventFactory;

/* @var $this yii\web\View */
/* @var $model HistorySearch */

$factory = Yii::$container->get(HistoryEventFactory::class);
$event = $factory->createHistoryEvent($model);
echo $this->render($event->getViewName(), $event->renderViewParams());
