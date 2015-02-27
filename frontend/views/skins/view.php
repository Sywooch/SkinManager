<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use kartik\icons\Icon;

Icon::map($this, Icon::FA);

/* @var $this yii\web\View */
/* @var $model common\models\Skins */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Скины', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php Modal::begin([
	'header' => '<h4 class="modal-title">Ссылки</h4>',
	'id' => 'links',
]) ?>
<div class="form-group">
	<label class="control-label" for="currentInput">Текущая страница</label>
	<input class="form-control" id="currentInput" type="text" value="<?= Url::canonical() ?>" onfocus="this.select()" readonly>
</div>
<div class="form-group">
	<label class="control-label" for="downloadInput">Скачать скин</label>
	<input class="form-control" id="downloadInput" type="text" value="<?= Url::to(['download', 'id' => $model->id], true) ?>" onfocus="this.select()" readonly>
</div>
<?php Modal::end() ?>

<div class="skins-view">
	<div class="row">
		<div class="col-md-6 sol-sm-6">
			<div class="panel panel-default">
				<div class="panel-body skin-images">
					<img src="<?= Yii::$app->skins->skinUrl($model->id, 'skins', 'front', 200) ?>" class="skin-full">
					<img src="<?= Yii::$app->skins->skinUrl($model->id, 'skins', 'back', 200) ?>" class="skin-full">
				</div>
			</div>
		</div>
		<div class="col-md-6 sol-sm-6">
			<ul class="list-group skin-details">
				<li class="list-group-item">
					<h2><?= $model->name ?></h2>
				</li>
				<a href="<?= Url::to(['index']) ?>" class="list-group-item">
					<span class="badge">Простые скины</span>
					Тип
				</a>
				<li class="list-group-item">
					<span class="badge"><?= $model->views ?></span>
					Просмотров
				</li>
				<li class="list-group-item">
					<span class="badge"><?= $model->downloads ?></span>
					Загрузок
				</li>
				<li class="list-group-item">
					<span class="badge"><?= date('d.m.Y H:m', $model->date) ?></span>
					Дата
				</li>
				<li class="list-group-item">
					<div class="pull-right rate-bar">
						<?= Html::a(Icon::show('thumbs-up'), ['rate', 'id' => $model->id, 'type' => 'up'], ['class' => 'btn btn-success btn-xs btn-rate']) ?>
						<div class="badge"><?= $model->rate ?></div>
						<?= Html::a(Icon::show('thumbs-down'), ['rate', 'id' => $model->id, 'type' => 'down'], ['class' => 'btn btn-danger btn-xs btn-rate']) ?>
					</div>
					Рейтинг
				</li>
				<li class="list-group-item">
					<?= Html::a(Icon::show('cloud-download') . 'Скачать', ['download', 'id' => $model->id], ['class' => 'btn btn-primary btn-block']) ?>
					<?= Html::button(Icon::show('share-alt') . 'Поделиться', [
						'data-toggle' => 'modal',
						'data-target' => '#links',
						'class' => 'btn btn-info btn-block',
					]) ?>
				</li>
			</ul>
		</div>
	</div>
</div>