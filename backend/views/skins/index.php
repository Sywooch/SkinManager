<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SkinsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Скины';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skins-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать Скин', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'contentOptions' => ['style' => 'width: 8%']
            ],
            [
                'attribute' => 'file',
                'format' => 'raw',
                'value' => function ($model) {
                    return Yii::$app->skins->image($model);
                },
            ],
            'name',
            [
                'attribute' => 'date',
                'format' => ['date', 'dd.MM.Y H:m'],
            ],
            'rate',
            'views',
//            'downloads',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
