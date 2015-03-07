<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1 class="page-header">Добавить скин/плащ</h1>

<div class="alert alert-info">
    Здесь Вы можете добавить свой скин или плащ, который, возможно, будет опубликован в каталоге. Все заявки проходят
    ручную модерацию.
</div>

<div class="row">
    <div class="col-sm-4">
        <?= Html::a('Добавить скин', ['skin'], ['class' => 'btn btn-primary btn-block']) ?>
    </div>
    <div class="col-sm-4">
        <?= Html::a('Добавить HD скин', ['hdskin'], ['class' => 'btn btn-primary btn-block']) ?>
    </div>
    <div class="col-sm-4">
        <?= Html::a('Добавить плащ', ['cloak'], ['class' => 'btn btn-primary btn-block']) ?>
    </div>
</div>