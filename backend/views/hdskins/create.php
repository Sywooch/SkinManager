<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\HDSkins */

$this->title = 'Create Hdskins';
$this->params['breadcrumbs'][] = ['label' => 'Hdskins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hdskins-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
