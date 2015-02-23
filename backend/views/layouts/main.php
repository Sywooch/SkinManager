<?php
use yii\helpers\Html;
use backend\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode(Yii::$app->params['title_prepend'] . $this->title . Yii::$app->params['title_append']) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>

	<?= $this->render('_header') ?>

	<?= $this->render('_main', ['content' => $content]) ?>

	<?= $this->render('_footer') ?>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
