<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Cloaks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cloaks-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

	<?= $form->field($model, 'file')->widget(FileInput::classname(), [
		'options' => ['accept' => 'image/png'],
		'pluginOptions' => [
			'previewFileType' => 'image',
			'showUpload' => false,
			'browseLabel' => 'Выбрать',
			'removeLabel' => 'Удалить',
			'removeClass' => 'btn btn-danger',
			'initialPreview' => $model->isNewRecord ? false : [
				Html::img(\Yii::$app->params['frontendUrl'] . '/uploads/cloaks/' . $model->name . '.jpg', ['class' => 'file-preview-image'])
			],
		]
	]) ?>

    <?= $form->field($model, 'rate')->textInput(['value' => 0]) ?>

    <?= $form->field($model, 'views')->textInput(['value' => 0]) ?>

    <?= $form->field($model, 'downloads')->textInput(['value' => 0]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
