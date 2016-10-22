<?php

$params = require(__DIR__ . '/params.php');

$config = [
	'id' => 'basic',
	'basePath' => dirname(__DIR__),
	'bootstrap' => ['log'],
	/* replace the above with the below on production server */
	/*'bootstrap' => ['log','assetsAutoCompress'],*/
	'timeZone' => 'Asia/Hong_Kong',
	//'defaultRoute'=>'site',
	'components' => [
		'assetsAutoCompress' =>
			[
				'class'                         => '\skeeks\yii2\assetsAuto\AssetsAutoCompressComponent',
				'enabled'                       => true,

				'readFileTimeout'               => 3,           //Time in seconds for reading each asset file

				'jsCompress'                    => true,        //Enable minification js in html code
				'jsCompressFlaggedComments'     => true,        //Cut comments during processing js

				'cssCompress'                   => true,        //Enable minification css in html code

				'cssFileCompile'                => true,        //Turning association css files
				'cssFileRemouteCompile'         => false,       //Trying to get css files to which the specified path as the remote file, skchat him to her.
				'cssFileCompress'               => true,        //Enable compression and processing before being stored in the css file
				'cssFileBottom'                 => false,       //Moving down the page css files
				'cssFileBottomLoadOnJs'         => false,       //Transfer css file down the page and uploading them using js

				'jsFileCompile'                 => true,        //Turning association js files
				'jsFileRemouteCompile'          => false,       //Trying to get a js files to which the specified path as the remote file, skchat him to her.
				'jsFileCompress'                => true,        //Enable compression and processing js before saving a file
				'jsFileCompressFlaggedComments' => true,        //Cut comments during processing js

				'htmlCompress'                  => true,        //Enable compression html
				'htmlCompressOptions'           =>              //options for compressing output result
					[
						'extra' => true,        //use more compact algorithm
						'no-comments' => true   //cut all the html comments
					],
			],
		'request' => [
			// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
			'cookieValidationKey' => 'lpDYLq1MMryk54PAPnwmigUlziDsoEuO',
			'enableCsrfValidation'=>true,
			'parsers'=>[
				'application/json'=>'yii\web\JsonParser',
			],
		],
		'cache' => [
			'class' => 'yii\caching\FileCache',
		],
		'user' => [
			'identityClass' => 'app\models\User',
			'enableAutoLogin' => true,
		],
		'errorHandler' => [
			'errorAction' => 'site/error',
		],
		'mailer' => [
			'class' => 'yii\swiftmailer\Mailer',
			// send all mails to a file by default. You have to set
			// 'useFileTransport' to false and configure a transport
			// for the mailer to send real emails.
			'useFileTransport' => true,
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
		'db' => require(__DIR__ . '/db.php'),

		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'rules' => [
				/*'test-rules/<year:\d{4}>/items-list' => 'test-rules/items-list',*/
				[
					'pattern'=>'<controller>',
					'route'=>'<controller>/index',
				],
				/*[
					'pattern' => 'test-rules/<category:\w+>/items-list',
					'route' => 'test-rules/items-list',
					'defaults' => ['category' => 'shopping']
					'pattern' => '<controller>',
					'route' => '<controller>/login',
					'defaults' => ['controller' => 'wc-authentication'],
				],*/
				[
					'pattern'=>'<lang:\w+>/<controller>/<action>',
					'route'=>'<controller>/<action>',
				],
				/*[
					'class'=>'yii\rest\UrlRule', 'controller'=>'book',
					'pluralize'=>true,
				],*/
				//'class'=>'app\components\TestUrlRule',
			],
		],
		'i18n' => [
			'translations' => [
				'app*' => [
					'class' => 'yii\i18n\PhpMessageSource',
					//'basePath' => '@app/messages',
					//'sourceLanguage' => 'en-US',
					'fileMap' => [
						'app' => 'app.php',
						//'app/error' => 'error.php',
					],
				],
			],
		],
	],
	'params' => $params,
];

if (YII_ENV_DEV) {
	// configuration adjustments for 'dev' environment
	$config['bootstrap'][] = 'debug';
	$config['modules']['debug'] = [
		'class' => 'yii\debug\Module',
	];
	$config['modules']['debug']['allowedIPs'] = ['*'];

	$config['bootstrap'][] = 'gii';
	$config['modules']['gii'] = [
		'class' => 'yii\gii\Module',
	];
	$config['modules']['gii']['allowedIPs'] = ['*'];
}

return $config;