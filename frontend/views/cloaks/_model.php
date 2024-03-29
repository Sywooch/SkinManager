<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Cloaks */
?>
<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
    <div class="panel panel-default skin-card">
        <div class="panel-body">
            <a href="<?= Url::to(['/cloaks/view', 'id' => $model->id]) ?>">
                <img src="<?= Yii::$app->cloaks->url($model) ?>"
                     class="skin-preview"
                     alt="<?= $model->name ?>">
            </a>

            <h4><?= $model->name ?></h4>

            <?= Html::a('Подробнее', ['/cloaks/view', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
</div>