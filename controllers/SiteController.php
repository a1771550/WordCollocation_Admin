<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\Cookie;
use yii\helpers\Url;

class SiteController extends BaseController
{
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only'=>['language','index'],
				'rules' => [
					[
						'actions'=>['language'],
						'allow'=>true,
						'roles'=>['?','@'],
					],
					[
						'actions' => ['index'],
						'allow' => true,
						'roles' => ['@'],
					],
				],
				'denyCallback' => function ($rule, $data)
				{

//            throw new ForbiddenHttpException(Yii::t('app', "Sorry, you don\'t have rights enough to access this page"));
					/*$url = Url::toRoute(['site/custom-error', 'name' => 'Forbidden', 'message' => 'Sorry, you don\'t have rights enough to access this page']);*/
					$url = Url::to(['/wc-authentication/login']);
					$this->redirect($url);
					//$this->redirect('site/error', '403');
					//$this->goHome();
				}
			],
			/*'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'logout' => ['post'],
				],
			],*/

		];
	}

	/**
	 * @inheritdoc
	 */
	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
			'captcha' => [
				'class' => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],
		];
	}

	public function actionLanguage()
	{
		$language = Yii::$app->request->get('language');
		$returnUrl = Yii::$app->request->get('returnUrl');
		$langCookie = new Cookie([
			'name' => 'language',
			'value' => $language,
			'expire' => time() + 60 * 60 * 24, //1 day
		]);
		Yii::$app->response->cookies->add($langCookie);
		return $this->redirect($returnUrl);
	}

	/**
	 * Displays homepage.
	 *
	 * @return string
	 */
	public function actionIndex()
	{
		return $this->render('index');
	}

	public function actionCustomError($name = null, $message = null)
	{
		return $this->render('customError', ['name' => $name, 'message' => $message]);
	}

}
