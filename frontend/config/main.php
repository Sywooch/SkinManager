<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'frontend',
    'name' => 'Каталог скинов',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'user' => [
            'class' => 'common\modules\user\components\User',
        ],
        'i18n' => [
            'translations' => [
                'user' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/modules/user/messages',
                ]
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => [
            'rules' => [
                '/' => 'site/index',
                '/skins' => 'skins/index',
                '/skins/page/<page:\d+>' => 'skins/index',
                '/skins/<id:\d+>' => 'skins/view',
                '/skins/download/<id:\d+>' => 'skins/download',
                '/hdskins' => 'hdskins/index',
                '/hdskins/page/<page:\d+>' => 'hdskins/index',
                '/hdskins/<id:\d+>' => 'hdskins/view',
                '/hdskins/download/<id:\d+>' => 'hdskins/download',
                '/cloaks' => 'cloaks/index',
                '/cloaks/page/<page:\d+>' => 'cloaks/index',
                '/cloaks/<id:\d+>' => 'cloaks/view',
                '/cloaks/download/<id:\d+>' => 'cloaks/download',
                '/search' => 'search/index',
                '/requests' => 'requests/index',
                'sitemap.xml' => 'sitemap/index',
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'modules' => [
        'user' => [
            'class' => 'common\modules\user\Module',
        ],
    ],
    'params' => $params,
];
