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
	<?php //$this->render('_search', ['model' => $searchModel]) ?>

    <p>
        <?= Html::a('Создать Плащ', ['create'], ['class' => 'btn btn-success']) ?>
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
				'label' => 'Файл',
				'value' => function ($model) {
					return \Yii::$app->params['frontendUrl'] . '/uploads/cloaks/' . $model->id . '.png';
				},
				'format' => ['image', ['width' => '150']],
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
