<?php
return [
    'language' => 'ru',
    'timeZone' => 'Europe/Kiev',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'db' => [
            'enableSchemaCache' => true,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'skins' => [
            'class' => 'common\components\skins\Skins',
        ],
        'cloaks' => [
            'class' => 'common\components\cloaks\Cloaks',
        ],
    ],
];
