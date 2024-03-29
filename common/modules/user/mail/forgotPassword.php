<?php

use yii\helpers\Url;

/**
 * @var string $subject
 * @var \common\modules\user\models\User $user
 * @var \common\modules\user\models\UserKey $userKey
 */
?>

<h3><?= $subject ?></h3>

<p><?= Yii::t("user", "Please use this link to reset your password:") ?></p>

<p>
    <a href="<?= Url::toRoute(["/user/reset", "key" => $userKey->key], true) ?>">
        <?= Url::toRoute(["/user/reset", "key" => $userKey->key], true) ?>
    </a>
</p>
