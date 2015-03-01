<?php

use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $cloaks common\models\Cloaks */

$this->title = 'HD Скины';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skins-index">
	<div class="page-header">
		<h1>HD Скины</h1>
	</div>

	<?php if ($count != 0): ?>
		<div class="row">
			<?php foreach ($models as $model): ?>
				<?= $this->render('/hdskins/_model', ['model' => $model]) ?>
			<?php endforeach ?>
		</div>
	<?php else: ?>
		<div class="alert alert-info col-sm-12">
			Пока что пусто :(
		</div>
	<?php endif ?>

	<?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>