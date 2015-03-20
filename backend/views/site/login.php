<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);

$this->title = 'Авторизация';
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="container">
    <div class="row" style="padding-top: 100px">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                    <?= $form->field($model, 'username')->label('Логин') ?>
                    <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>
                    <?= $form->field($model, 'rememberMe')->checkbox()->label('Запомнить меня') ?>
                    <div class="form-group">
                        <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>