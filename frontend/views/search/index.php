<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\OfficialSearch */
?>
<h1 class="page-header">
    Поиск
</h1>

<div>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'type')->dropDownList([
        '1' => 'Скины',
        '2' => 'HD Скины',
        '3' => 'Официальные',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>