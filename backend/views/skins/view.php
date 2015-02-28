<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Skins */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Скины', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skins-view">

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
		'template' => "<tr><th>{label}</th><td>{value}</td></tr>",
        'attributes' => [
            'id',
			[
				'attribute' => 'file',
				'label' => 'Фото',
				'format' => 'raw',
				'value' => Yii::$app->skins->image($model) . Yii::$app->skins->image($model, 'back'),
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
