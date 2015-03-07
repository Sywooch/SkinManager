<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Skins */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="skins-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'file')->fileInput() ?>

    <?= $form->field($model, 'rate')->textInput(['value' => $model->isNewRecord ? 0 : $model->rate]) ?>

    <?= $form->field($model, 'views')->textInput(['value' => $model->isNewRecord ? 0 : $model->views]) ?>

    <?= $form->field($model, 'downloads')->textInput(['value' => $model->isNewRecord ? 0 : $model->downloads]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
