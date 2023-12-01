<?php
use app\models\search\HistorySearch;
use app\widgets\HistoryList\events\HistoryEventFactory;

/* @var $this yii\web\View */
/** @var $model HistorySearch */

$factory = new HistoryEventFactory($model);
$event = $factory->createHistoryEvent();
echo $this->render($event->getViewName(), $event->renderParams());
