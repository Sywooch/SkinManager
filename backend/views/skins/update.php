<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Skins */

$this->title = 'Редактировать Скин: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Скины', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="skins-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
