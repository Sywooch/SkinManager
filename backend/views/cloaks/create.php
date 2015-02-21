<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Cloaks */

$this->title = 'Создать Плащ';
$this->params['breadcrumbs'][] = ['label' => 'Плащи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cloaks-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
