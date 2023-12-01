<?php

use app\widgets\Export\Export;
use app\widgets\HistoryList\HistoryList;

$this->title = 'Americor Test';
?>

<div class="site-index">
<!--    --><?php //= Export::widget([]) ?>
    <?= HistoryList::widget([
//            'dataProvider' => $historyDataProvider,
    ]) ?>
</div>
