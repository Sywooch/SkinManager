<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $cloaks common\models\Cloaks */

$this->title = 'Плащи';
?>
<div class="cloaks-index">
	<div class="page-header">
		<h1>Плащи</h1>
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

	<?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>