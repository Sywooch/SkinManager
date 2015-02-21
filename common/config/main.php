<?php
return [
	'language' => 'ru',
	'sourceLanguage' => 'ru',
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
    ],
];
