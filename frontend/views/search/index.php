<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model frontend\models\SearchForm */
/* @var $dataProvider frontend\models\SearchForm */
/* @var $itemView frontend\models\SearchForm */

$this->title = 'Поиск';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1 class="page-header">
    <?= $this->title ?>
</h1>

<div class="alert alert-info">
    Введите имя скина и выбиритие тип скинов
</div>

<div id="searchForm">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'type')->dropDownList([
        '1' => 'Скины',
        '2' => 'HD Скины',
        '3' => 'Официальные скины',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<?php if ($dataProvider && $itemView): ?>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => $itemView,
    ]) ?>
<?php endif ?>