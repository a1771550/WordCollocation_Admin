<?php
$params = array_merge(
	require(__DIR__ . '/../../config/params.php'),
	//require(__DIR__ . '/../../common/config/params-local.php'),
	require(__DIR__ . '/params.php')
);

return [
	'id' => 'app-api',
	'basePath' => dirname(__DIR__),
	'controllerNamespace' => 'api\controllers',
	'bootstrap' => ['log'],
	'modules' => [],
	'components' => [
		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false,
		],
		'user' => [
			'identityClass' => '\yii\models\User',
			'enableSession' => false,
			'loginUrl' => null
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
	],
	'params' => $params,
];