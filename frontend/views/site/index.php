<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $skins common\models\Skins */
/* @var $hdskins common\models\Hdskins */
/* @var $cloaks common\models\Cloaks */

$this->title = 'Главная';
?>
<div class="page-header">
    <h2>Скины</h2>
</div>

<div class="row">
    <?php foreach ($skins as $model): ?>
        <?= $this->render('/skins/_model', ['model' => $model]) ?>
    <?php endforeach ?>
</div>

<?= Html::a('Все Скины', ['/skins/index'], ['class' => 'btn btn-info col-sm-4 col-sm-offset-4']) ?>

<div class="page-header">
    <h2>HD Скины</h2>
</div>

<div class="row">
    <?php foreach ($hdskins as $model): ?>
        <?= $this->render('/hdskins/_model', ['model' => $model]) ?>
    <?php endforeach ?>
</div>

<?= Html::a('Все HD Скины', ['/hdskins/index'], ['class' => 'btn btn-info col-sm-4 col-sm-offset-4']) ?>

<div class="page-header">
    <h2>Плащи</h2>
</div>

<div class="row">
    <?php foreach ($cloaks as $model): ?>
        <?= $this->render('/cloaks/_model', ['model' => $model]) ?>
    <?php endforeach ?>
</div>

<?= Html::a('Все Плащи', ['/cloaks/index'], ['class' => 'btn btn-info col-sm-4 col-sm-offset-4']) ?>
