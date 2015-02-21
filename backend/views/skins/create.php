<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Skins */

$this->title = 'Create Skins';
$this->params['breadcrumbs'][] = ['label' => 'Skins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skins-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
