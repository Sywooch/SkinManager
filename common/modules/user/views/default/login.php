<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var app\models\LoginForm $model
 */

$this->title = Yii::t('user', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-default-login">

    <h1 class="page-header"><?= Html::encode($this->title) ?></h1>

    <p><?= Yii::t("user", "Please fill out the following fields to login:") ?></p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],

    ]); ?>

    <?= $form->field($model, 'username') ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'rememberMe', [
        'template' => "<div class=\"col-lg-offset-2 col-lg-3\"><div class=\"checkbox\">{input}{label}</div></div>",
    ])->checkbox() ?>

    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
            <?= Html::submitButton(Yii::t('user', 'Login'), ['class' => 'btn btn-primary']) ?>

            <br/><br/>
            <?= Html::a(Yii::t("user", "Register"), ["/user/register"]) ?> /
            <?= Html::a(Yii::t("user", "Forgot password") . "?", ["/user/forgot"]) ?> /
            <?= Html::a(Yii::t("user", "Resend confirmation email"), ["/user/resend"]) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

    <?php if (Yii::$app->get("authClientCollection", false)): ?>
        <div class="col-lg-offset-2">
            <?= yii\authclient\widgets\AuthChoice::widget([
                'baseAuthUrl' => ['/user/auth/login']
            ]) ?>
        </div>
    <?php endif; ?>

</div>