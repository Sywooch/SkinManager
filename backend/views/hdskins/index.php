<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\HDSkinsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hdskins';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hdskins-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Hdskins', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'date',
            'rate',
            'views',
            // 'downloads',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
