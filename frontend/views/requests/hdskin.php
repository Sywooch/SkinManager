<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model */

$this->title = 'Добавить HD скин';
$this->params['breadcrumbs'][] = ['label' => 'Добавить', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1 class="page-header">Добавить HD скин</h1>

    <div class="alert alert-info">
        <b>Имя</b> - короткое название HD скина, что он напоминает, и т.д. Максимальная длина - 100 символов. Может
        состоять только из букв русского и английского алфавита.<br>
        <b>Файл</b> - файл HD скина. Максимальная длина - 1024px, высота - 1024px
    </div>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => 100]) ?>

<?= $form->field($model, 'file')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Создать', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>