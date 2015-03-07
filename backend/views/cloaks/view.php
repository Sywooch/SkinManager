<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Cloaks */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Плащи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cloaks-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Удалить плащ?',
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
                'format' => 'raw',
                'value' => Yii::$app->cloaks->image($model),
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
