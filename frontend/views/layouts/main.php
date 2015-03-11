<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;

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
    <meta name="description" content="На данном сайте вы можете скачать скины для minecraft, HD скины minecraft, пдащи minecraft, скины minecraft бесплатно">
    <meta name="keywords" content="Скины minecraft, скины для minecraft, minecraft skins, hd скины minecraft">
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
