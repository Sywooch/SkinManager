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
		'user' => [
            'class' => 'common\modules\user\components\User',
        ],
		'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
            'messageConfig' => [
                'from' => ['admin@website.com' => 'Admin'], // this is needed for sending emails
                'charset' => 'UTF-8',
            ]
        ],
		'i18n' => [
            'translations' => [
                'user' => [
					'class' => 'yii\i18n\PhpMessageSource',
					'basePath' => '@common/modules/user/messages',
				]
			],
        ],
    ],
	'modules' => [
		'user' => [
			'class' => 'common\modules\user\Module',
		],
	],
];
