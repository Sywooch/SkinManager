<?php

use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $cloaks common\models\Cloaks */

$this->title = 'Плащи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cloaks-index">
	<div class="page-header">
		<h1>Плащи</h1>
	</div>

	<?php if ($count != 0): ?>
		<div class="row">
			<?php foreach ($models as $model): ?>
				<?= $this->render('/cloaks/_model', ['model' => $model]) ?>
			<?php endforeach ?>
		</div>
	<?php else: ?>
		<div class="alert alert-info col-sm-12">
			Пока что пусто :(
		</div>
	<?php endif ?>

	<?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>