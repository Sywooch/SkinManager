<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CloaksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Плащи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cloaks-index">

    <h1><?= Html::encode($this->title) ?></h1>
	<?= $this->render('_search', ['model' => $searchModel]) ?>

    <p>
        <?= Html::a('Создать Плащ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            'date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
