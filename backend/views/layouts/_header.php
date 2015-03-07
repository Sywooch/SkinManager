<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

/* @var $this \yii\web\View */
?>
<header>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->params['project_name'],
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    // Left Menu Items
    $leftItems = [
        ['label' => 'Скины', 'url' => ['/skins/index']],
        ['label' => 'HD Скины', 'url' => ['/hdskins/index']],
        ['label' => 'Плащи', 'url' => ['/cloaks/index']],
        ['label' => 'Заявки', 'url' => ['/requests/index']],
    ];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => $leftItems,
    ]);

    // Right Menu Items
    $rightItems = [
        [
            'label' => \Yii::$app->params['frontendUrl'],
            'url' => \Yii::$app->params['frontendUrl'],
            'linkOptions' => ['target' => '_blank'],
        ]
    ];
    if (Yii::$app->user->isGuest) {
        $rightItems[] = ['label' => 'Войти', 'url' => ['/site/login']];
    } else {
        $rightItems[] = [
            'label' => 'Выйти (' . Yii::$app->user->identity->username . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $rightItems,
    ]);

    NavBar::end();
    ?>
</header>