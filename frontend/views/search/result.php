<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Search */
/* @var $dataProvider frontend\models\Search */
?>
<h1 class="page-header">Поиск</h1>

<div class="alert alert-info">
    Результаты по запросу: <?= Html::encode($model->name) ?>
</div>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => $itemView,
]) ?>
