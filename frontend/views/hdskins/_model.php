<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Cloaks */
?>
<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
	<div class="panel panel-default skin-card">
		<div class="panel-body">
			<a href="<?= Url::to(['/hdskins/view', 'id' => $model->id]) ?>">
				<img src="<?= Yii::$app->skins->url($model) ?>"
					 data-to="<?= Yii::$app->skins->url($model, 'back') ?>"
					 data-from="<?= Yii::$app->skins->url($model) ?>"
					 class="skin-preview"
					 alt="<?= $model->name ?>">
			</a>

			<h4><?= $model->name ?></h4>

			<?= Html::a('Подробнее', ['/hdskins/view', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		</div>
	</div>
</div>