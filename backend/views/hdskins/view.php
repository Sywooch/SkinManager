<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\HDSkins */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'HD Скины', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hdskins-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Удалить скин?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
			[
				'attribute' => 'file',
				'label' => 'Фото',
				'format' => 'raw',
				'value' => Yii::$app->skins->skinImage($model->id, 'hdskins', 'front') .
						   Yii::$app->skins->skinImage($model->id, 'hdskins', 'back'),
			],
            'name',
            [
				'attribute' => 'date',
				'format' => ['date', 'dd.MM.Y H:m'],
			],
            'rate',
            'views',
            'downloads',
        ],
    ]) ?>

</div>
