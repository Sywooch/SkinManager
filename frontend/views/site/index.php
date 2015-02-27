<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $skins common\models\Skins */
/* @var $hdskins common\models\Hdskins */

$this->title = 'Главная';
?>
<div class="site-index">
	<div class="page-header">
		<h2>Скины</h2>
	</div>

	<div class="row">
		<?php foreach ($skins as $model): ?>
			<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
				<div class="panel panel-default skin-card">
					<div class="panel-body">
						<a href="<?= Url::to(['/skins/view', 'id' => $model->id]) ?>">
							<img src="<?= Yii::$app->skins->skinUrl($model->id, 'skins', 'front') ?>"
								 data-to="<?= Yii::$app->skins->skinUrl($model->id, 'skins', 'back') ?>"
								 data-from="<?= Yii::$app->skins->skinUrl($model->id, 'skins', 'front') ?>"
								 class="skin-preview"
								 alt="<?= $model->name ?>">
						</a>

						<h4><?= $model->name ?></h4>

						<?= Html::a('Подробнее', ['/skins/view', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
					</div>
				</div>
			</div>
		<?php endforeach ?>
	</div>
	<?= Html::a('Все Скины', ['/skins/index'], ['class' => 'btn btn-info col-sm-4 col-sm-offset-4']) ?>

	<div class="page-header">
		<h2>HD Скины</h2>
	</div>

	<div class="row">
		<?php foreach ($hdskins as $model): ?>
			<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
				<div class="panel panel-default skin-card">
					<div class="panel-body">
						<a href="<?= Url::to(['/skins/view', 'id' => $model->id]) ?>">
							<img src="<?= Yii::$app->skins->skinUrl($model->id, 'hdskins', 'front') ?>"
								 data-to="<?= Yii::$app->skins->skinUrl($model->id, 'hdskins', 'back') ?>"
								 data-from="<?= Yii::$app->skins->skinUrl($model->id, 'hdskins', 'front') ?>"
								 class="skin-preview"
								 alt="<?= $model->name ?>">
						</a>

						<h4><?= $model->name ?></h4>

						<?= Html::a('Подробнее', ['/skins/view', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
					</div>
				</div>
			</div>
		<?php endforeach ?>
	</div>
	<?= Html::a('Все HD Скины', ['/hdskins/index'], ['class' => 'btn btn-info col-sm-4 col-sm-offset-4']) ?>

	<div class="page-header">
		<h2>Плащи</h2>
	</div>

	<div class="row">
		<?php foreach ($cloaks as $model): ?>
			<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
				<div class="panel panel-default skin-card">
					<div class="panel-body">
						<a href="<?= Url::to(['/cloaks/view', 'id' => $model->id]) ?>">
							<img src="<?= Yii::$app->skins->cloakUrl($model->id) ?>"
								 data-to="<?= Yii::$app->skins->cloakUrl($model->id) ?>"
								 data-from="<?= Yii::$app->skins->cloakUrl($model->id) ?>"
								 class="skin-preview"
								 alt="<?= $model->name ?>">
						</a>

						<h4><?= $model->name ?></h4>

						<?= Html::a('Подробнее', ['/cloaks/view', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
					</div>
				</div>
			</div>
		<?php endforeach ?>
	</div>
	<?= Html::a('Все Плащи', ['/cloaks/index'], ['class' => 'btn btn-info col-sm-4 col-sm-offset-4']) ?>
</div>