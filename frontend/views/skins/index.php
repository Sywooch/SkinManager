<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $cloaks common\models\Cloaks */

$this->title = 'Скины';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skins-index">
	<div class="page-header">
		<h1>Скины</h1>
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

	<?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>