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

    // Left menu items
    $leftItems = [
        ['label' => 'Главная', 'url' => ['/site/index']],
        ['label' => 'Скины', 'url' => ['/skins/index']],
        ['label' => 'HD Скины', 'url' => ['/hdskins/index']],
        ['label' => 'Плащи', 'url' => ['/cloaks/index']],
    ];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => $leftItems,
    ]);

    // Right menu items
    if (Yii::$app->user->isGuest) {
        $rightItems[] = ['label' => 'Регистрация', 'url' => ['/user/register']];
        $rightItems[] = ['label' => 'Войти', 'url' => ['/user/login']];
    } else {
        $rightItems = [
            ['label' => 'Добавить скин', 'url' => ['/requests/index']],
            [
                'label' => 'Выйти',
                'url' => ['/user/logout'],
                'linkOptions' => ['data-method' => 'post']
            ],
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $rightItems,
    ]);

    NavBar::end();
    ?>
</header>