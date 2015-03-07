<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\RequestsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Запросы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="requests-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'contentOptions' => ['style' => 'width: 8%'],
            ],
            [
                'attribute' => 'file',
                'contentOptions' => ['style' => 'width: 20%'],
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->type === 'Скин' or $model->type === 'HD Скин') {
                        return Yii::$app->skins->image($model) . Yii::$app->skins->image($model, 'back');
                    } elseif ($model->type === 'Плащ') {
                        return Yii::$app->cloaks->image($model);
                    }
                },
            ],
            'name',
            'type',
            'user_id',
            [
                'attribute' => 'date',
                'format' => ['date', 'dd.MM.Y H:m'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{accept} {delete}',
                'buttons' => [
                    'accept' => function ($url, $model) {
                        return Html::a('<i class="glyphicon glyphicon-ok"></i>', $url);
                    },
                ],
            ],
        ],
    ]); ?>

</div>
