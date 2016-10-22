<?php
/**
 * Created by PhpStorm.
 * User: kevinlau
 * Date: 10/5/16
 * Time: 1:54 AM
 */

namespace app\controllers;

use app\models\LoginForm;
use Yii;
use yii\helpers\Url;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class WcAuthenticationController extends BaseController
{
	public function behaviors() {
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'logout' => ['post'],
				],
			],
			'access' => [
				'class' => AccessControl::className(),
				'only' => ['login','logout','gen-pwd'],
				'rules' => [
					[
						'actions'=>['login', 'gen-pwd'],
						'allow' => true,
						'roles' => ['?'],
					],
					[
						'actions' => ['logout'],
						'allow' => true,
						'roles' => ['@'],
					],
				],
				'denyCallback' => function($rule, $data) {

//            throw new ForbiddenHttpException(Yii::t('app', "Sorry, you don\'t have rights enough to access this page"));
					/*$url = Url::toRoute(['site/custom-error', 'name' => 'Forbidden', 'message' => 'Sorry, you don\'t have rights enough to access this page']);*/
					$url = Url::to(['/wc-authentication/login']);
					$this->redirect($url);
					//$this->redirect('site/error', '403');
				}
			],
		];
	}

	public function actionGenPwd(){
		return Yii::$app->security->generatePasswordHash('111111');
	}

	public function actionLogin(){
		$error = null;
		$returnUrl = Yii::$app->request->get('returnUrl', Url::to(['/site/index']));
		$model= new LoginForm();
		$model->returnUrl = $returnUrl;
		if($model->load(Yii::$app->request->post())){
			if(($model->validate()) && ($model->user!=null)){
				$duration = $model->rememberMe?3600*24*30:0;
				Yii::$app->user->login($model->user, $duration);
				return $this->redirect($model->returnUrl);
				//return $this->goBack();
			}else{
				$error=Yii::t('app','Username/Password error');
			}
		}
		return $this->render('login', ['model'=>$model, 'error'=>$error, 'returnUrl'=>$returnUrl]);
	}

	public function actionLogout(){
		Yii::$app->user->logout();
		return $this->redirect(['login']);
		//return $this->goHome();
	}
}