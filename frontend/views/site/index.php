<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $skins common\models\Skins */
/* @var $hdskins common\models\Hdskins */

$this->title = 'Главная';
?>
<div class="site-index">
	<div class="page-header">
		<h2>Скины <small>Последние простые скины</small></h2>
	</div>

	<div class="row">
		<?php foreach ($skins as $skin): ?>
		<?php endforeach; ?>
	</div>

	<div class="page-header">
		<h2>HD Скины <small>Последние HD скины</small></h2>
	</div>

	<div class="row">
		<?php foreach ($hdskins as $hdskin): ?>
		<div class="col-xs-6 col-sm-3 col-sm-4">
			<div class="panel panel-default skin-card">
				<div class="panel-body">
					<?= Html::img($hdskin->getUrl($hdskin->id), ['class' => 'img-responsive'])	?>
					<h4><?= $hdskin->name ?></h4>
					<?= Html::a('Подробнее', ['/hdskins/view', 'id' => $hdskin->id], ['class' => 'btn btn-primary']) ?>
				</div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	<!--<div class="text-center">-->
	<?= Html::a('Больше скинов', ['/skins/index'], ['class' => 'btn btn-info col-sm-4 col-sm-offset-4']) ?>
	<!--</div>-->
</div>