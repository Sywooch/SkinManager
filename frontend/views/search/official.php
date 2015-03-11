<?php

use yii\helpers\Html;
use yii\helpers\Url;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model frontend\models\Official */

$this->title = $model->name;
$this->params['breadcrumbs'][] = 'Официальные скины';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skins-view">
    <div class="row">
        <div class="col-md-6 sol-sm-6">
            <div class="panel panel-default">
                <div class="panel-body skin-images">
                    <img src="/showskin.php?url=<?= $model->url ?>&mode=7" class="skin-full">
                    <img src="/showskin.php?url=<?= $model->url ?>&mode=8" class="skin-full">
                </div>
            </div>
        </div>
        <div class="col-md-6 sol-sm-6">
            <ul class="list-group skin-details">
                <li class="list-group-item">
                    <h2><?= $model->name ?></h2>
                </li>
                <li class="list-group-item">
                    <span class="badge">Официальные скины</span>
                    Тип
                </li>
                <li class="list-group-item">
                    <?= Html::a(FA::icon('cloud-download') . ' Скачать', $model->url,
                        ['class' => 'btn btn-primary btn-block', 'target' => '_blank']) ?>
                </li>
            </ul>
        </div>
    </div>
</div>