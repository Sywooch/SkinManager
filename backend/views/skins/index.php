<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SkinsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Skins';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skins-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Skins', ['create'], ['class' => 'btn btn-success']) ?>
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
