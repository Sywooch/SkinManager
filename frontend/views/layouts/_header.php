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
			['label' => 'HD Скины', 'url' => ['/hdskins/about']],
			['label' => 'Плащи', 'url' => ['/cloaks/about']],
		];
		echo Nav::widget([
			'options' => ['class' => 'navbar-nav'],
			'items' => $leftItems,
		]);

		// Right menu items
		if (Yii::$app->user->isGuest) {
			$rightItems[] = ['label' => 'Регистрация', 'url' => ['/site/signup']];
			$rightItems[] = ['label' => 'Войти', 'url' => ['/site/login']];
		} else {
			$rightItems = [
				['label' => 'Добавить скин', 'url' => ['/request/index']],
				[
					'label' => 'Выйти (' . Yii::$app->user->identity->username . ')',
					'url' => ['/site/logout'],
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