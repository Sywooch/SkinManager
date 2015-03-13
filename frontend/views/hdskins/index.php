<?php

use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $models common\models\Cloaks */

$this->title = 'HD Скины';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skins-index">
    <div class="page-header">
        <h1>HD Скины</h1>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            Сортировать по:
            <div class="btn-group btn-group-sm">
                <?= $sort->link('date', [
                    'label' => 'дате',
                    'class' => 'btn btn-primary',
                ]) ?>
                <?= $sort->link('name', [
                    'label' => 'названию',
                    'class' => 'btn btn-primary',
                ]) ?>
                <?= $sort->link('rate', [
                    'label' => 'рейтингу',
                    'class' => 'btn btn-primary',
                ]) ?>
                <?= $sort->link('downloads', [
                    'label' => 'загрузкам',
                    'class' => 'btn btn-primary',
                ]) ?>
            </div>
        </div>
    </div>

    <?php if ($count != 0): ?>
        <div class="row">
            <?php foreach ($models as $model): ?>
                <?= $this->render('/hdskins/_model', ['model' => $model]) ?>
            <?php endforeach ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info col-sm-12">
            Записи не найдены
        </div>
    <?php endif ?>

    <?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>